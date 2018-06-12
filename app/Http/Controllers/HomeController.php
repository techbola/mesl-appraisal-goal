<?php

namespace Cavidel\Http\Controllers;

use Cavidel\User;
use Cavidel\CallMemoAction;
use Cavidel\Todo;
use Cavidel\ProjectTask;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $user = auth()->user();
      // Include where status is not done
      $pending_meeting_actions = CallMemoAction::where('UserID', $user->id)->count();
      $todos_today = Todo::where('UserID', $user->id)->where('Done', 0)->get();
      $tasks = ProjectTask::where('StaffID', $user->staff->StaffRef)->whereHas('steps', function($q){
        $q->where('Done', 0);
      })->get();
      // dd($tasks);
      return view('dashboard', compact('pending_meeting_actions', 'todos_today', 'tasks'));
    }

    public function read_notification($id)
    {
      $user = auth()->user();
      dd($user->unreadNotifications);
    }

}
