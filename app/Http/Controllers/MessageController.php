<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Staff;
use App\MessageRecipient;

use DB;

class MessageController extends Controller
{
  public function inbox()
  {
    $user = auth()->user();
    // $messages = Message::where('ToID', $user->id)->orderBy('MessageRef', 'desc')->get();
    $messages = $user->inbox;

    return view('messages.inbox', compact('user', 'messages'));
  }
  public function compose()
  {
    $user = auth()->user();
    if ($user->is_superadmin) {
      $staffs = Staff::all();
    } else {
      $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
    }

    return view('messages.compose', compact('user', 'staffs'));
  }

  public function send_message(Request $request)
  {
    $this->validate($request, [
      'Subject' => 'required',
      'Body' => 'required',
    ]);
    try {
      DB::beginTransaction();

      $user = auth()->user();
      $message = new Message;
      $message->FromID = $user->id;
      $message->Subject = $request->Subject;
      $message->Body = $request->Body;
      $message->save();

      foreach ($request->to as $to) {
        $rec = new MessageRecipient;
        $rec->MessageID = $message->MessageRef;
        $rec->UserID = $to;
        $rec->save();
      }

      DB::commit();
      return redirect()->route('inbox')->with('success', 'Your message was sent successfully.');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('inbox')->with('danger', 'Message sending failed.');
    }

  }

  public function reply_message(Request $request, $parent_id)
  {
    $user = auth()->user();

    $parent = Message::find($parent_id);

    $this->authorize('view-message', $parent);

    $this->validate($request, [
      'Body' => 'required',
    ]);

    try {
      DB::beginTransaction();

      $message = new Message;
      $message->FromID = $user->id;
      $message->Subject = 'Re: '.$parent->Subject;
      $message->Body = $request->Body;
      $message->ParentID = $parent_id;
      $message->save();

      // Parent's recipients to array
      $people = $parent->recipients->pluck('id')->toArray();
      // Get reply sender's array key
      $my_key = array_search($user->id, $people);
      if ($user->id == $parent->FromID) {
        // $people = array_diff($people, [$my_key]);
        $people = $people;
      } else {
        // Remove reply sender, replace with parent's sender. (haystack, start_key, end_key, replacement)
        array_splice($people, $my_key, $my_key, $parent->FromID);
      }

      foreach ($people as $to) {
        $rec = new MessageRecipient;
        $rec->MessageID = $message->MessageRef;
        $rec->UserID = $to;
        $rec->save();
      }

      DB::commit();
      return redirect()->route('view_message', $parent->MessageRef)->with('success', 'Your reply was sent successfully.');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()->route('view_message', $parent->MessageRef)->with('danger', 'Message sending failed.');
    }

  }

  public function view_message($id, $reply = null)
  {
    $message = Message::find($id);
    $user = auth()->user();

    $this->authorize('view-message', $message);

    if (!empty($reply)) {
      $msg_read = MessageRecipient::where('MessageID', $reply)->where('UserID', $user->id)->first();
      if (!empty($msg_read->IsRead)) {
        $msg_read->IsRead = TRUE;
        $msg_read->save();
      }
    }

    return view('messages.view', compact('message', 'user'));
  }

}
