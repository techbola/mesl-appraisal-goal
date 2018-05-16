<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Carbon;

class TodoController extends Controller
{

    public function todos_calendar()
    {
      $user = auth()->user();
      // $todos_array = $user->todos->toArray();
      // dd($todos_array);
      return view('todos.calendar', compact('user', 'todos_array'));
    }

    public function get_todos()
    {
      $user = auth()->user();
      // $todos = $user->todos->where('Done', '0')->get();
      $todos = Todo::where('UserID', $user->id)->where('Done', '0')->get();
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
      $todo->UserID = $user->id;
      $todo->Initiator = $user->id;
      $todo->CompanyID = $user->staff->CompanyID;
      // $todo->Description = $todo->Description;
      $todo->save();

      return redirect()->route('todos_calendar')->with('success', 'Todo was added successfully');
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
      // $todo->Description = $todo->Description;
      $todo->update();

      return redirect()->route('todos')->with('success', 'Todo was updated successfully');
    }

    public function index()
    {
      $user = auth()->user();

      if (empty($_GET['date'])) {
        $todos = Todo::where('UserID', $user->id)->where('Done', '0')->get();
        $dones = Todo::where('UserID', $user->id)->where('Done', '1')->get();
      } else {
        $todos = Todo::where('UserID', $user->id)->where('DueDate', $_GET['date'])->where('Done', '0')->get();
        $dones = Todo::where('UserID', $user->id)->where('DueDate', $_GET['date'])->where('Done', '1')->get();
        $date = Carbon::parse($_GET['date'])->format('jS M, Y');
      }
      return view('todos.index_', compact('user', 'todos','dones', 'date'));
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

}
