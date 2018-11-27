<?php

namespace Cavi\Http\Controllers;

use Cavi\User;
use Cavi\CallMemoAction;
use Cavi\Todo;
use Cavi\ProjectTask;
use Cavi\Bulletin;
use Cavi\EventSchedule;
use Cavi\LeaveRequest;
use Cavi\Memo;
use Cavi\Staff;
use Cavi\PolicyStatement;
use Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user       = auth()->user();
        $today      = date('Y-m-d');
        $start_week = Carbon::parse($today)->startofWeek()->format('Y-m-d');
        $end_week   = Carbon::parse($today)->endofWeek()->format('Y-m-d');
        $next7days  = date('Y-m-d', strtotime('+7 days'));
        $past7days  = date('Y-m-d', strtotime('-7 days'));

        // // Include where status is not done
        // $pending_meeting_actions = CallMemoAction::where('UserID', $user->id)->count();
        // $todos_today             = Todo::where('UserID', $user->id)->where('Done', 0)->whereDate('DueDate', '=', $today)->get();
        // // $todos_week = Todo::where('UserID', $user->id)->where('Done', 0)->whereDate('DueDate', '>=', $today)->whereDate('DueDate', '<', $next7days)->get();
        // $todos_week = Todo::where('UserID', $user->id)->where('Done', 0)->whereDate('DueDate', '>=', $start_week)->whereDate('DueDate', '<=', $end_week)->orderBy('DueDate', 'asc')->get();
        // $tasks      = ProjectTask::where('StaffID', $user->staff->StaffRef)->whereHas('steps', function ($q) {
        //     $q->where('Done', 0);
        // })->get();
        // $messages          = $user->unread_messages;
        // $leave_requests    = LeaveRequest::where('ApproverID', $user->id)->where('CompletedFlag', '0')->get();
        // $bulletins         = Bulletin::where('CompanyID', $user->CompanyID)->whereDate('ExpiryDate', '>=', $today)->with('poster')->orderBy('CreatedDate', 'desc')->get();
        // $events            = EventSchedule::where('CompanyID', $user->CompanyID)->whereDate('StartDate', '>=', $today)->orWhereDate('EndDate', '>=', $today)->get();
        // $birthday_users         = Staff::where('CompanyID', $user->CompanyID)->where('DateofBirth', '!=', '')->where('DateofBirth', '!=', null)->get();
        // $birthdays = [];
        // foreach ($birthday_users as $b_user) {
        //   if (Carbon::parse($b_user->DateofBirth)->isBirthday()) {
        //     $birthdays[] = $b_user;
        //   }
        // }
        // $unapproved_memos  = Memo::where('ApproverID', $user->id)->where('NotifyFlag', 1)->get();
        // $policy_statements = PolicyStatement::whereDate('EntryDate', '>=', $past7days)->whereDate('EntryDate', '<=', $next7days)->get();
        // // dd($tasks);
        // return view('dashboard', compact('pending_meeting_actions', 'todos_today', 'tasks', 'bulletins', 'events', 'todos_week', 'messages', 'leave_requests', 'unapproved_memos', 'birthdays', 'policy_statements'));

        $bulletins = Bulletin::whereDate('ExpiryDate', '>=', $today)->with('poster')->orderBy('CreatedDate', 'desc')->get();
        $events = EventSchedule::whereDate('StartDate', '>=', $today)->orWhereDate('EndDate', '>=', $today)->get();
        return view('dashboard', compact('bulletins', 'events'));
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

    public function settings()
    {
        return view('settings');
    }

}
