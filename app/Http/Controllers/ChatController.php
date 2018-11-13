<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\Chat;
use Cavi\User;
use Cavi\Staff;
// use Cavi\Events\NewChatUser;
use Event;
use Cavi\Events\NewChatMsg;
use Auth;
use DB;
use Carbon\Carbon;
use Notification;

class ChatController extends Controller
{
  public function chat_list()
  {
    $chats = Chat::select('session', 'email', 'user_id', DB::raw('MAX(created_at) as date') )->where('status', 'active')->where('is_customer', '1')->groupBy('email', 'session', 'user_id')->get();
    // dd($chats);
    return view('chats.index', compact('chats'));
  }


  public function chat()
  {
    $user = Auth::user();
    // $partner = User::find($id);

    // $last_active = Chat::where('email', $user->email)->where('status', 'active')->orderBy('id', 'desc')->first();
    // if ($last_active) {
    //   session(['chat_session'=>$last_active->session]);
    //   $session = $last_active->session;
    // } else {
    //   $session = substr(md5(time()), 0, 8);
    //   session(['chat_session' => $session]);
    // }
    $employees = Staff::where('CompanyID', $user->CompanyID)->where('UserID', '!=', $user->id)->get();
    $chats = Chat::where('FromID', $user->id)->where('ToID', $user->id)->orderBy('id', 'desc')->get();

    return view('chats.chat', compact('employees', 'user', 'chats'));
  }


  public function save_chat(Request $request)
  {
    $this->validate($request, [
      'ToID' => 'required',
    ]);
    $user = Auth::user();

      $chat = new Chat;
      $chat->Body = $request->message;
      $chat->FromID = $user->id;
      $chat->ToID = $request->ToID;
      $chat->IsRead = '0';
      $chat->save();

      // $data = array(
      //   'id'=>$chat->id,
      //   'email'=>$chat->email,
      //   'body'=>$chat->body,
      //   'session'=>$chat->session,
      //   'room'=>$chat->room,
      //   'user_id'=>$chat->user_id,
      //   'FromID'=>$chat->user_id,
      //   'ToID'=>$chat->user_id,
      //   'username'=>$user->name,
      //   'status'=>$chat->status,
      //   'date'=>$chat->created_at->diffForHumans()
      // );
    $chat = Chat::where('id', $chat->id)->first();

    Event::fire(new NewChatMsg($chat));

    // Notification::send($approvers, new PendingTrade($FCYTrade));
    // Event::fire(new NewChatUser($data));
  }

  public function load_chats($id)
  {
    $user = Auth::user();
    $partner = User::find($id);
    // if ($user->hasRole(['Admin', 'staff', 'accountant', 'dealer', 'office manager', 'asst office manager', 'cashier'])) {
    //   // session(['chat_session'=>$session]);
    //   $chats = Chat::where('session', $session)->with('user')->get();
    // } else {
    //   $last_active = Chat::where('email', $user->email)->where('status', 'active')->orderBy('id', 'desc')->first();
    //   $chats = Chat::where('session', $last_active->session)->with('user')->get();
    // }

    $chats = Chat::where(function($query1) use($user, $partner){
      $query1->where('FromID', $user->id)->where('ToID', $partner->id);
    })->orWhere(function($query2) use($user, $partner){
      $query2->where('FromID', $partner->id)->where('ToID', $user->id);
    })->orderBy('id')->with(['from', 'to'])->get();

    foreach ($chats as $chat) {
      $chat->IsRead = '1';
      $chat->update();

      $chat->date = $chat->created_at->diffForHumans();
    }
    return $chats;
  }

  public function search_users(Request $request)
  {
    $search = $request->search;
    $user = auth()->user();
    $employees = Staff::where('CompanyID', $user->CompanyID)->where('UserID', '!=', $user->id)->whereHas('user', function($q) use($search){
      $q->where('first_name', 'LIKE', '%'.$search.'%')->orWhere('last_name', 'LIKE', '%'.$search.'%');
    })->get();
    return $employees;
    foreach ($employees as $staff) {
      $staff->avatar_url = $staff->avatar_url();
    }
  }


  public function end_chat($session)
  {
    $user = Auth::user();
    $chats = Chat::where('session', $session)->get();
    foreach ($chats as $chat) {
      $chat->status = 'closed';
      $chat->save();
    }
    if ($user->hasRole('customer')) {
      return redirect()->route('home')->with('success', 'You have ended your chat.');
    }
    return redirect()->back()->with('success', 'This chat has been closed');
  }
}
