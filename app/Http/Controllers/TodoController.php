<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Todo;
use Cavidel\Staff;
use Carbon;

use Notification;
use Cavidel\Notifications\TodoAssigned;

class TodoController extends Controller
{

    public function todos_calendar()
    {
      $user = auth()->user();
      // $todos_array = $user->todos->toArray();
      // dd($todos_array);
      $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
      return view('todos.calendar', compact('user', 'todos_array', 'staffs'));
    }

    public function get_todos($staff_id = '')
    {
      $user = auth()->user();

      if (!empty($staff_id)) {
        $staff = Staff::find($staff_id);
        $todos = Todo::where('UserID', $staff->UserID)->where('Done', '0')->get();
      } else {
        $todos = Todo::where('UserID', $user->id)->where('Done', '0')->get();
      }
      // $todos = $user->todos->where('Done', '0')->get();
      $todos_array = [];
      $count = '0';
      foreach ($todos as $todo) {
        $todos_array[$count]['ref'] = $todo->TodoRef;
        $todos_array[$count]['title'] = $todo->Todo;
        $todos_array[$count]['start'] = $todo->DueDate;
        $todos_array[$count]['end'] = $todo->DueDate;
        $todos_array[$count]['description'] = str_limit($todo->Description, '100');
        $count++;
      }
      // $events_json = $events->toJson();
      // dd($events_array);
      return json_encode($todos_array);
    }


    public function save_todo(Request $request)
    {
      $user = auth()->user();

      $this->validate($request, [
        'Todo' => 'required',
        'DueDate' => 'required',
      ]);

      $todo = new Todo;
      $todo->Todo = $request->Todo;
      $todo->DueDate = $request->DueDate;
      $todo->UserID = $request->UserID;
      $todo->Initiator = $user->id;
      $todo->CompanyID = $user->staff->CompanyID;
      // $todo->Description = $todo->Description;
      $todo->save();

      if ($user->id != $request->UserID) {
        Notification::send($todo->user, new TodoAssigned($todo));
      }

      return redirect()->back()->with('success', 'Todo was added successfully');
    }
    public function update_todo(Request $request, $id)
    {
      $user = auth()->user();

      $this->validate($request, [
        'Todo' => 'required',
        'DueDate' => 'required',
      ]);

      $todo = Todo::find($id);
      $todo->Todo = $request->Todo;
      $todo->DueDate = $request->DueDate;
      $todo->UserID = $request->UserID;
      // $todo->Description = $todo->Description;
      $todo->update();

      return redirect()->back()->with('success', 'Todo was updated successfully');
    }

    public function index()
    {
      $user = auth()->user();

      if (empty($_GET['date'])) {
        $todos = Todo::where('UserID', $user->id)->where('Done', '0')->orderBy('DueDate', 'desc')->get();
        $dones = Todo::where('UserID', $user->id)->where('Done', '1')->orderBy('DueDate', 'desc')->get();
      } else {
        $todos = Todo::where('UserID', $user->id)->where('DueDate', $_GET['date'])->where('Done', '0')->orderBy('DueDate', 'desc')->get();
        $dones = Todo::where('UserID', $user->id)->where('DueDate', $_GET['date'])->where('Done', '1')->orderBy('DueDate', 'desc')->get();
        $date = Carbon::parse($_GET['date'])->format('jS M, Y');
      }
      $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
      return view('todos.index_', compact('user', 'todos','dones', 'date', 'staffs'));
    }


    public function toggle_todo(Request $request, $id)
    {
      $todo = Todo::find($id);
      if ($todo->Done == '0') {
        $todo->Done = '1';
      } else {
        $todo->Done = '0';
      }
      $todo->update();

      return 'OK';
    }


    public function delete_todo(Request $request, $id)
    {
      $todo = Todo::find($id);
      $todo->delete();

      return redirect()->back()->with('success', 'To-Do item was deleted successfully.');
    }

    public function assigned_todos()
    {
      $user = auth()->user();
      $todo_users = Todo::select('UserID')->where('Initiator', $user->id)->where('UserID', '!=', $user->id)->with('user')->GroupBy('UserID')->get();
      // dd($todo_users);
      return view('todos.assigned', compact('todo_users'));
    }

    public function get_assigned_todos($id)
    {
      $user = auth()->user();
      $todos = Todo::where('Initiator', $user->id)->where('UserID', $id)->with('user')->orderBy('DueDate', 'desc')->get();
      // dd($todo_users);
      return $todos;
    }

}
