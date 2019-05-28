<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Todo;
use MESL\Staff;
use Carbon;
use MESL\User;
use DB;
use Gate;

use Notification;
use MESL\Notifications\TodoAssigned;

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
        $todos = Todo::whereHas('assignees', function ($q) use ($staff) {
          $q->where('id', $staff->UserID);
        })->where('Done', '0')->get();
      } else {
        $todos = Todo::whereHas('assignees', function ($q) use ($user) {
          $q->where('id', $user->id);
        })->where('Done', '0')->get();
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
        // 'DueDate' => 'required',
      ]);

      $todo = new Todo;
      $todo->Todo = $request->Todo;
      $todo->DueDate = $request->DueDate;
      $todo->UserID = $request->UserID;
      $todo->Initiator = $user->id;
      $todo->StartTime = $request->StartTime;
      $todo->EndTime   = $request->EndTime;
      $todo->CompanyID = $user->staff->CompanyID;
      // $todo->Description = $todo->Description;
      $todo->save();
      $todo->assignees()->attach($request->assignees);

      array_diff( $request->assignees, (array)$user->id );
      // if ($user->id != $request->UserID) {
        Notification::send($todo->assignees, new TodoAssigned($todo));
      // }

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
      $todo->StartTime = $request->StartTime;
      $todo->EndTime   = $request->EndTime;
      // $todo->Description = $todo->Description;
      $todo->update();
      if (!empty($request->assignees)) {
        $todo->assignees()->detach();
        $todo->assignees()->attach($request->assignees);
      }

      return redirect()->back()->with('success', 'Todo was updated successfully');
    }


    public function update_todo_ajax(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();

            $this->validate($request, [
                'Todo'    => 'required',
                'DueDate' => 'required',
            ]);

            $todo            = Todo::find($id);
            $todo->Todo      = $request->Todo;
            $todo->DueDate   = $request->DueDate;
            $todo->StartTime = $request->StartTime;
            $todo->EndTime   = $request->EndTime;
            // $todo->UserID = $request->UserID;
            $todo->update();
            if (!empty($request->assignees)) {
                $todo->assignees()->detach();
                $todo->assignees()->attach($request->assignees);
            }
            // $todo->Description = $todo->Description;
            DB::commit();
            return response($todo, 200, $headers = ['Content-type' => 'application/json']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e, 500, $headers = ['Content-type' => 'application/json']);
        }

    }
    
    public function get_todo($id)
    {
        $todo = Todo::find($id);
        return $todo;
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
    public function unassigned()
    {
      $user = auth()->user();
      $todos = Todo::where('UserID', $user->id)->where('DueDate', NULL)->where('Done', '0')->orderBy('Todo', 'desc')->get();
      $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
      return view('todos.unassigned', compact('todos', 'user', 'staffs'));
    }


    public function toggle_todo(Request $request, $id)
    {
      $todo      = Todo::find($id);
      $checkonly = $_GET['checkonly'] ?? '';

      if ($todo->Done == '0') {
          $todo->Done = '1';
          if (empty($checkonly)) {
              $todo->CompletedDate = Carbon::now();
          }
      } else {
          $todo->Done = '0';
      }
      $todo->update();

      return $todo;
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
      // $todo_users = Todo::select('UserID')->where('Initiator', $user->id)->where('UserID', '!=', $user->id)->where('Done', '0')->with('user')->GroupBy('UserID')->get();

      $todo_users = User::where('id', '!=', $user->id)->whereHas('todos', function ($q) use ($user) {
        $q->where('Initiator', $user->id);
      })->get();
      // dd($todo_users);
      $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();

      return view('todos.assigned', compact('todo_users', 'staffs'));
    }

    public function get_assigned_todos($id)
    {
      $user = auth()->user();
      $today = date('Y-m-d');

      // selected dates or this week
      $from = $_GET['from'] ?? Carbon::parse($today)->startofYear()->format('Y-m-d');
      $to   = $_GET['to'] ?? Carbon::parse($today)->endofYear()->format('Y-m-d');

      if (Gate::allows('hr-admin')) {
        $todos = Todo::whereHas('assignees', function ($q) use ($id) {
            $q->where('id', $id);
        })->where('Done', '0')->whereDate('DueDate', '>=', $from)->whereDate('DueDate', '<=', $to)->orderBy('DueDate', 'desc')->get();
      } else {
          $todos = Todo::where('Initiator', $user->id)->whereHas('assignees', function ($q) use ($id) {
              $q->where('id', $id);
          })->where('Done', '0')->whereDate('DueDate', '>=', $from)->whereDate('DueDate', '<=', $to)->orderBy('DueDate', 'desc')->get();
      }

      // return $todos;
      return response(compact('todos', 'todo_user'), 200, $headers = ['Content-type' => 'application/json']);
    }

    public function get_assigned_todos_done($id)
    {
      $user = auth()->user();
      $today = date('Y-m-d');

      // selected dates or this week
      $from = $_GET['from'] ?? Carbon::parse($today)->startofWeek()->format('Y-m-d');
      $to   = $_GET['to'] ?? Carbon::parse($today)->endofWeek()->format('Y-m-d');

      if (Gate::allows('hr-admin')) {
        $todos = Todo::whereHas('assignees', function ($q) use ($id) {
            $q->where('id', $id);
        })->where('Done', '1')->whereDate('CompletedDate', '>=', $from)->whereDate('CompletedDate', '<=', $to)->orderBy('CompletedDate', 'desc')->get();
      } else {
          $todos = Todo::where('Initiator', $user->id)->whereHas('assignees', function ($q) use ($id) {
              $q->where('id', $id);
          })->where('Done', '1')->whereDate('CompletedDate', '>=', $from)->whereDate('CompletedDate', '<=', $to)->orderBy('CompletedDate', 'desc')->get();
      }
      // $todos = Todo::where('Initiator', $user->id)->where('UserID', $id)->where('Done', '1')->with('user')->orderBy('DueDate', 'desc')->get();
      // dd($todo_users);
      return $todos;
    }

}
