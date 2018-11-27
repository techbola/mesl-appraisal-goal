<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Message;
use MESL\EventSchedule;

class SearchController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if (!empty($_GET['q'])) {
      $q = $_GET['q'];

      $inbox_messages = $user->inbox->where('Subject', 'LIKE', '%'.$q.'%')->orWhere('Body', 'LIKE', '%'.$q.'%');
      $sent_messages = $user->sent_messages;
      $events = EventSchedule::where('CompanyID', $user->staff->CompanyID)->get();
    }


    return view('search.index', compact('q','inbox_messages', 'sent_messages', 'events'));

  }

}
