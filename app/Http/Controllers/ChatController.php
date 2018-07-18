<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Chat;
use Cavidel\Events\NewChatMsg;
use Cavidel\Events\NewChatUser;
use Event;
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

  public function save_chat(Request $request)
  {
    $user = Auth::user();
    // if ($request->session()->has('chat_session')) {
    if (!empty($request->session)) {
      $request->session()->forget('chat_session');
      session(['chat_session'=>$request->session]);
      $session = $request->session;
    } else {
      $active_chat = Chat::where('email', $user->email)->where('status', 'active')->orderBy('id', 'desc')->first();
      if($active_chat){
        $session = $active_chat->session;
        session(['chat_session'=>$session]);
      }
    }

    $prev_chat = Chat::where('session', $session)->orderBy('id', 'desc')->first();

    if (empty($prev_chat) || $prev_chat->status == 'active') {
      $chat = new Chat;
      $chat->email = $request->email;
      $chat->body = $request->message;
      $chat->room = 'general';
      $chat->user_id = $user->id;
      if (!empty($session)) {
        $chat->session = $session;
      } else {
        $chat->session = $session = session('chat_session');
        // $request->session()->forget('chat_session');
        // session(['chat_session'=>$chat->session]);
      }
      if ($user->hasRole('customer')) {
        $chat->is_customer = '1';
      } else {
        $chat->is_customer = '0';
      }

      $chat->status = 'active';
      $chat->save();

      $data = array(
        'id'=>$chat->id,
        'email'=>$chat->email,
        'body'=>$chat->body,
        'session'=>$chat->session,
        'room'=>$chat->room,
        'user_id'=>$chat->user_id,
        'username'=>$user->name,
        'status'=>$chat->status,
        'date'=>$chat->created_at->diffForHumans()
      );

    } else {
      // return redirect()->back()->with('error', 'This chat session has been closed.');
      $data = array(
        'id'=>'1',
        'email'=>'system',
        'body'=>'This session has been closed',
        'session'=>$session,
        'room'=>'system',
        'user_id'=>'1',
        'username'=>'SYSTEM',
        'status'=>'closed',
        'date'=>Carbon::parse(date('Y-m-d'))->diffForHumans()
      );
    }

    Event::fire(new NewChatMsg($data));

    // 2nd condition not necessary, just in case user gets the same session as their previous (closed) chat. The save_chat() function can't be used in closed chats so all is well.
    if (empty($prev_chat) || $prev_chat->status == 'closed') {

      Notification::send($approvers, new PendingTrade($FCYTrade));
      Event::fire(new NewChatUser($data));
    }

  }

  public function load_chats()
  {
    $user = Auth::user();
    $session = session('chat_session');
    if ($user->hasRole(['Admin', 'staff', 'accountant', 'dealer', 'office manager', 'asst office manager', 'cashier'])) {
      // session(['chat_session'=>$session]);
      $chats = Chat::where('session', $session)->with('user')->get();
    } else {
      $last_active = Chat::where('email', $user->email)->where('status', 'active')->orderBy('id', 'desc')->first();
      $chats = Chat::where('session', $last_active->session)->with('user')->get();
    }

    foreach ($chats as $chat) {
      $chat->date = $chat->created_at->diffForHumans();
    }
    return $chats;
  }

  public function chat($session = null)
  {
    $user = Auth::user();
    if (!empty($session)) {
      session(['chat_session'=>$session]);
      $session = $session;
    } else {
      $last_active = Chat::where('email', $user->email)->where('status', 'active')->orderBy('id', 'desc')->first();
      if ($last_active) {
        session(['chat_session'=>$last_active->session]);
        $session = $last_active->session;
      } else {
        $session = substr(md5(time()), 0, 8);
        session(['chat_session' => $session]);
      }
    }
    $chat = Chat::where('session', $session)->orderBy('id', 'desc')->first();
    return view('chats.customer_chat', compact('session', 'user', 'chat'));
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
