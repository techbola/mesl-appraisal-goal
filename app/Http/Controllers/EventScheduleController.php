<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventSchedule;

class EventScheduleController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    $events = EventSchedule::where('ComapnyID', $user->staff->CompanyID)->get();
    $events_array = $events->toArray();
    // dd($events_array);
    return view('events.index', compact('events', 'events_array'));
  }

  public function get_events()
  {
    $events = EventSchedule::all();
    $events_array = [];
    $count = '0';
    foreach ($events as $event) {
      $events_array[$count]['ref'] = $event->EventRef;
      $events_array[$count]['title'] = $event->Event;
      $events_array[$count]['start'] = $event->StartDate;
      $events_array[$count]['end'] = $event->EndDate;
      $events_array[$count]['description'] = str_limit($event->Description, '100');
      $count++;
    }
    // $events_json = $events->toJson();
    // dd($events_array);
    return $events_array;
  }

  public function save_event(Request $request)
  {
    $user = auth()->user();

    $this->validate($request, [
      'Event' => 'required',
      'StartDate' => 'required',
      'EndDate' => 'required'
    ]);

    $event = new EventSchedule;
    $event->Event = $request->Event;
    $event->StartDate = $request->StartDate;
    $event->EndDate = $request->EndDate;
    $event->StartTime = $request->StartTime;
    $event->EndTime = $request->EndTime;
    $event->Initiator = $user->id;
    $event->CompanyID = $user->staff->CompanyID;
    $event->Description = $request->Description;
    $event->save();

    return redirect()->route('events')->with('success', 'Event was added successfully');
  }

  public function view_event($id)
  {
    $event = EventSchedule::find($id);

    return view('events.view', compact('event'));
  }

  public function update_event(Request $request, $id)
  {
    $user = auth()->user();

    $this->validate($request, [
      'Event' => 'required',
      'StartDate' => 'required',
      'EndDate' => 'required'
    ]);

    $event = EventSchedule::find($id);
    $event->Event = $request->Event;
    $event->StartDate = $request->StartDate;
    $event->EndDate = $request->EndDate;
    $event->StartTime = $request->StartTime;
    $event->EndTime = $request->EndTime;
    $event->Initiator = $user->id;
    $event->CompanyID = $user->staff->CompanyID;
    $event->Description = $request->Description;
    $event->save();

    return redirect()->route('events')->with('success', 'Event was updated successfully');
  }

  public function delete_event(Request $request, $id)
  {
    $event = EventSchedule::find($id);
    $event->delete();

    return redirect()->route('events')->with('success', 'The event was deleted successfully');

  }

}
