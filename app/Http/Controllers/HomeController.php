<?php

namespace MESL\Http\Controllers;

use MESL\User;
use MESL\CallMemoAction;
use MESL\Todo;
use MESL\ProjectTask;
use MESL\Bulletin;
use MESL\EventSchedule;
use MESL\LeaveRequest;
use MESL\Memo;
use MESL\Staff;
use MESL\PolicyStatement;
use MESL\Config;
use MESL\PayrollMonthly;
use MESL\Litigation;
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
        $events    = EventSchedule::whereDate('StartDate', '>=', $today)->orWhereDate('EndDate', '>=', $today)->get();
        return view('dashboard', compact('bulletins', 'events', 'user'));
    }

    public function read_notification($id)
    {
        $user = auth()->user();
        dd($user->unreadNotifications);
    }

    public function admin_dashboard()
    {
        $user              = auth()->user();
        $outstanding_bills = [];

        $config      = Config::first();
        $system_date = $config->TradeDate;
        // $quarter     = \Carbon\Carbon::parse($system_date)->quarter;
        $quarter = 0;

        if ($quarter == 1) {
            $quarter_start_date = $config->First_Quarter_Start;
            $present_date       = $config->First_Quarter_End;
        } elseif ($quarter == 2) {
            $quarter_start_date = $config->Second_Quarter_Start;
            $present_date       = $config->Second_Quarter_End;
        } elseif ($quarter == 3) {
            $quarter_start_date = $config->Third_Quarter_Start;
            $present_date       = $config->Third_Quarter_End;
        } elseif ($quarter == 4) {
            $quarter_start_date = $config->Fourth_Quarter_Start;
            $present_date       = $config->Fourth_Quarter_End;
        } elseif ($quarter == 0) {
            $quarter_start_date = $config->YearStart;
            $present_date       = $config->YearEnd;
        }

        $current_pay_month = PayrollMonthly::max('PayMonth');
        $current_pay_year  = PayrollMonthly::max('PayYear');
        // return dd($current_pay_month);

        $staff_total =
        // Staff::where('PayMonth', $current_pay_month)
        // ->where('PayYear', $current_pay_year)
        Staff::all()
            ->count();
        // return dd($staff_total);

        $files_total = Litigation::all()->count();

        $inflow_summary     = [];
        $cash_sales_summary = [];

        $exp_summary = [];

        $netflow = [];

        return view('admin-dashboard', compact('outstanding_bills', 'netflow', 'staff_total', 'files_total', 'inflow_summary', 'exp_summary', 'cash_sales_summary'));
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
