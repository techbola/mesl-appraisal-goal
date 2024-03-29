<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Message;
use MESL\User;
use MESL\Staff;
use MESL\MessageRecipient;
use MESL\MessageFile;

use Event;
use MESL\Events\NewMessageEvent;

use Notification;
use MESL\Notifications\NewMessage;

use DB;
use Storage;

class MessageController extends Controller
{
  public function inbox()
  {
    $user = auth()->user();
    // $messages = Message::where('ToID', $user->id)->orderBy('MessageRef', 'desc')->get();
    $messages = $user->inbox()->paginate(20);

    return view('messages.inbox', compact('user', 'messages'));
  }

  public function sent_messages()
  {
    $user = auth()->user();
    $messages = $user->sent_messages()->paginate(20);
    // dd($messages);
    return view('messages.sent', compact('user', 'messages'));
  }

  public function compose()
  {
    $user = auth()->user();
    if ($user->is_superadmin) {
      $staffs = Staff::all();
    } else {
      $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->where('UserID', '!=', $user->id)->get();
    }

    if (!empty($_GET['forward'])) {
      $fw = $_GET['forward'];
      $forward = Message::find($fw);
    }

    return view('messages.compose', compact('user', 'staffs', 'forward'));
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

      if (!empty($request->MessageFiles)) {
          foreach ($request->MessageFiles as $file) {
            $filename = str_replace(' ', '_', $file->getClientOriginalName() );
            // $saved    = $file->storeAs('meeting_files', $filename);
            // $saved    = Storage::disk('public')->put('message_files/'.$filename, $file);
            $saved    = $file->storeAs('message_files', $filename, 'public');

            if ($saved) {
              $new_file = new MessageFile;
              $new_file->Filename = $filename;
              $new_file->MessageID = $message->MessageRef;
              $new_file->UserID = $user->id;
              $new_file->save();
            }

          }
      }




      // $msg = Message::where('MessageRef', $message->MessageRef)->with('recipients')->first();
      // Notifs
      $msg['from'] = $message->sender->FullName;
      $msg['subject'] = $message->Subject;
      $msg['body'] = str_limit($message->Body, 50);
      // $msg['recipients'] = $message->recipients->pluck('id')->toArray();
      $msg['recipients'] = $request->to;

      DB::commit();

      Event::fire(new NewMessageEvent($msg));
      Notification::send($message->recipients, new NewMessage($message));
      // dd($msg);

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
        // Remove reply sender, replace with parent's sender. (haystack, start_key, count, replacement)
        array_splice($people, $my_key, 1, $parent->FromID);
      }

      foreach ($people as $to) {
        $rec = new MessageRecipient;
        $rec->MessageID = $message->MessageRef;
        $rec->UserID = $to;
        $rec->save();
      }


      if (!empty($request->MessageFiles)) {
          foreach ($request->MessageFiles as $file) {
            $filename = str_replace(' ', '_', $file->getClientOriginalName() );
            // $saved    = $file->storeAs('meeting_files', $filename);
            // $saved    = Storage::disk('public')->put('message_files/'.$filename, $file);
            $saved    = $file->storeAs('message_files', $filename, 'public');

            if ($saved) {
              $new_file = new MessageFile;
              $new_file->Filename = $filename;
              $new_file->MessageID = $message->MessageRef;
              $new_file->UserID = $user->id;
              $new_file->save();
            }

          }
      }

      // Notifs
      $msg['from'] = $message->sender->FullName;
      $msg['subject'] = $message->Subject;
      $msg['body'] = str_limit($message->Body, 50);
      // $msg['recipients'] = $message->recipients->pluck('id')->toArray();
      $msg['recipients'] = $people;

      DB::commit();

      Event::fire(new NewMessageEvent($msg));
      $people_users = User::whereIn('id', $people)->get();
      Notification::send($people_users, new NewMessage($message));

      return redirect()->route('view_message', $parent->MessageRef)->with('success', 'Your reply was sent successfully.');
    } catch (Exception $e) {

      DB::rollback();
      return redirect()->route('view_message', $parent->MessageRef)->with('danger', 'Message sending failed.');
    }

  }

  public function view_message($id, $reply = null)
  {
    $message = Message::find($id);
    // $message = Message::where('MessageRef', $id)->with('recipients')->first();
    // dd($message);
    $user = auth()->user();

    $this->authorize('view-message', $message);

    if (!empty($reply)) {
      $msg_read = MessageRecipient::where('MessageID', $reply)->where('UserID', $user->id)->first();
      if (isset($msg_read->IsRead)) {
        DB::statement("UPDATE tblMessageRecipients SET IsRead = 'TRUE' WHERE MessageID = ".$reply." AND UserID = ".$user->id);
      }
    }

    return view('messages.view', compact('message', 'user'));
  }

  public function search_messages()
  {
    $user = auth()->user();
    if (!empty($_GET['q'])) {
      $q = $_GET['q'];
    } else {
      $q = '';
    }
    // $results = Message::where('Subject', 'LIKE', '%'.$q.'%')->orWhere('Body', 'LIKE', '%'.$q.'%')->paginate(20);
    $results = Message::where(function($query1) use($user){
      $query1->where('FromID', $user->id)->orWhereHas('recipients', function($query) use($user){
        $query->where('users.id', $user->id);
      });
    })->where(function($query2) use($q){
      $query2->where('Subject', 'LIKE', '%'.$q.'%')->orWhere('Body', 'LIKE', '%'.$q.'%');
    })->paginate(20);
    return view('messages.search', compact('results'));
  }

}
