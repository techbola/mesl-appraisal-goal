<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\EventSchedule;
use MESL\User;
use MESL\CompanyDepartment;
use MESL\Staff;

use MESL\Notifications\NewCalendarEvent;
use Notification;

class EventScheduleController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    // $events = EventSchedule::where('CompanyID', $user->staff->CompanyID)->get();
    $events = EventSchedule::where('CompanyID', $user->staff->CompanyID)->get();
    $events_array = $events->toArray();
    // dd($events_array);
    $departments = CompanyDepartment::where('is_deleted', false)->get();

    return view('events.index', compact('events', 'events_array', 'departments'));
  }

  public function get_events()
  {
    $user = auth()->user();
    $user_departments = explode(',', $user->staff->DepartmentID);
    $events = EventSchedule::where('CompanyID', $user->staff->CompanyID)->whereIn('DepartmentID', $user_departments)->get();
    $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->where('DateofBirth', '!=', '')->where('DateofBirth', '!=', NULL)->get();
    $events_array = [];
    $count = '0';

    foreach ($events as $event) {
      $events_array[$count]['ref'] = $event->EventRef;
      $events_array[$count]['title'] = $event->Event;
      $events_array[$count]['start'] = $event->StartDate;

      $date[$count] = date_create($event->EndDate);
      date_add($date[$count], date_interval_create_from_date_string('1 days'));
      $end_date = date_format($date[$count], 'Y-m-d');

      $events_array[$count]['end'] = $end_date;
      $events_array[$count]['description'] = str_limit($event->Description, '100');
      $count++;
    }
    // foreach ($staffs as $staff) {
    //   $events_array[$count]['ref'] = '00',
    //   $events_array[$count]['title'] = $staff->FullName.'\'s Birthday',
    //   $events_array[$count]['start'] = $staff->DateofBirth,
    //     $date[$count] = date_create($staff->DateofBirth);
    //     date_add($date[$count], date_interval_create_from_date_string('1 days'));
    //     $end_date = date_format($date[$count], 'Y-m-d');
    //   $events_array[$count]['end'] = $end_date,
    //   $events_array[$count]['description'] = '';
    //   $count++;
    // }

    // $events_json = $events->toJson();
    // dd($events_array);
    return json_encode($events_array);
  }

  public function save_event(Request $request)
  {
    $user = auth()->user();

    $this->validate($request, [
      'Event' => 'required',
      'StartDate' => 'required',
      'EndDate' => 'required',
      'DepartmentID' => 'required',
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
    $event->DepartmentID = $request->DepartmentID;
    $event->save();

    $all = User::whereHas('staff', function($query) use($user) {
      $query->where('CompanyID', $user->staff->CompanyID);
    })->get();

    $one = User::first();

    Notification::send($all, new NewCalendarEvent($event));

    return redirect()->route('events')->with('success', 'Event was added successfully');
  }

  public function view_event($id)
  {
    $user = auth()->user();
    $event = EventSchedule::find($id);
    $departments = CompanyDepartment::all();

    return view('events.view', compact('event', 'departments'));
  }

  public function update_event(Request $request, $id)
  {

    $event = EventSchedule::find($id);
    $user = auth()->user();

    $this->authorize('edit-event', $event);

    $this->validate($request, [
      'Event' => 'required',
      'StartDate' => 'required',
      'EndDate' => 'required',
      'DepartmentID' => 'required',
    ]);

    $event->Event = $request->Event;
    $event->StartDate = $request->StartDate;
    $event->EndDate = $request->EndDate;
    $event->StartTime = $request->StartTime;
    $event->EndTime = $request->EndTime;
    $event->Initiator = $user->id;
    $event->CompanyID = $user->staff->CompanyID;
    $event->Description = $request->Description;
    $event->DepartmentID = $request->DepartmentID;
    $event->save();

    return redirect()->route('events')->with('success', 'Event was updated successfully');
  }

  public function delete_event(Request $request, $id)
  {
    $event = EventSchedule::find($id);

    $this->authorize('edit-event', $event);

    $event->delete();

    return redirect()->route('events')->with('success', 'The event was deleted successfully');

  }

}
