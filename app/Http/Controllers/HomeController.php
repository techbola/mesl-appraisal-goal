<?php

namespace Cavidel\Http\Controllers;

use Cavidel\User;
use Cavidel\CallMemoAction;
use Cavidel\Todo;
use Cavidel\ProjectTask;
use Cavidel\Bulletin;
use Cavidel\EventSchedule;
use Cavidel\LeaveRequest;
use Cavidel\Memo;
use Cavidel\Staff;
use Cavidel\PolicyStatement;
use Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $user = auth()->user();
      $today = date('Y-m-d');
      $start_week = Carbon::parse($today)->startofWeek()->format('Y-m-d');
      $end_week = Carbon::parse($today)->endofWeek()->format('Y-m-d');
      $next7days = date('Y-m-d', strtotime('+7 days'));
      $past7days = date('Y-m-d', strtotime('-7 days'));
      // Include where status is not done
      $pending_meeting_actions = CallMemoAction::where('UserID', $user->id)->count();
      $todos_today = Todo::where('UserID', $user->id)->where('Done', 0)->whereDate('DueDate', '=', $today)->get();
      // $todos_week = Todo::where('UserID', $user->id)->where('Done', 0)->whereDate('DueDate', '>=', $today)->whereDate('DueDate', '<', $next7days)->get();
      $todos_week = Todo::where('UserID', $user->id)->where('Done', 0)->whereDate('DueDate', '>=', $start_week)->whereDate('DueDate', '<=', $end_week)->orderBy('DueDate', 'asc')->get();
      $tasks = ProjectTask::where('StaffID', $user->staff->StaffRef)->whereHas('steps', function($q){
        $q->where('Done', 0);
      })->get();
      $messages = $user->unread_messages;
      $leave_requests = LeaveRequest::where('ApproverID', $user->id)->where('CompletedFlag', '0')->get();
      $bulletins = Bulletin::where('CompanyID', $user->CompanyID)->whereDate('ExpiryDate', '>=', $today)->with('poster')->orderBy('CreatedDate', 'desc')->get();
      $events = EventSchedule::where('CompanyID', $user->CompanyID)->whereDate('StartDate', '>=', $today)->orWhereDate('EndDate', '>=', $today)->get();
      $birthdays = Staff::where('CompanyID', $user->CompanyID)->where('DateofBirth', '!=', '')->where('DateofBirth', '!=', NULL)->get();
      $unapproved_memos = Memo::where('ApproverID', $user->id)->where('NotifyFlag', 1)->get();
      $policy_statements = PolicyStatement::whereDate('EntryDate', '>=', $past7days)->whereDate('EntryDate', '<=', $next7days)->get();
      // dd($tasks);
      return view('dashboard', compact('pending_meeting_actions', 'todos_today', 'tasks', 'bulletins', 'events', 'todos_week', 'messages', 'leave_requests', 'unapproved_memos', 'birthdays', 'policy_statements'));
    }

    public function read_notification($id)
    {
      $user = auth()->user();
      dd($user->unreadNotifications);
    }

    public function help()
    {
      return view('help');
    }

}
