<?php

namespace Cavidel\Http\Controllers;

use Cavidel\User;
use Cavidel\CallMemoAction;
use Cavidel\Todo;
use Cavidel\ProjectTask;
use Cavidel\Bulletin;
use Cavidel\EventSchedule;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      // return date('Y-m-d', strtotime('+30 days'));
      $user = auth()->user();
      $today = date('Y-m-d');
      // Include where status is not done
      $pending_meeting_actions = CallMemoAction::where('UserID', $user->id)->count();
      $todos_today = Todo::where('UserID', $user->id)->where('Done', 0)->get();
      $todos_week = Todo::where('UserID', $user->id)->where('Done', 0)->get();
      $tasks = ProjectTask::where('StaffID', $user->staff->StaffRef)->whereHas('steps', function($q){
        $q->where('Done', 0);
      })->get();
      $bulletins = Bulletin::where('CompanyID', $user->CompanyID)->whereDate('ExpiryDate', '>=', $today)->with('poster')->limit('3')->get();
      $events = EventSchedule::where('CompanyID', $user->CompanyID)->limit('3')->get();
      // dd($tasks);
      return view('dashboard', compact('pending_meeting_actions', 'todos_today', 'tasks', 'bulletins', 'events', 'todos_week'));
    }

    public function read_notification($id)
    {
      $user = auth()->user();
      dd($user->unreadNotifications);
    }

}
