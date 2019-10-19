<?php

namespace App\Http\Controllers;

use App\Http\Resources\Task as TaskRsource;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\Datatables\Datatables;

class TaskController extends Controller
{
    public function index()
    {   
        return view('tasks.index');
    }

    public function list()
    {
        $tasks = Task::all();
 
        return response()->json($tasks);
    }

    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|min:3|max:49',
            'screen_name' => 'required|min:3|max:49',
            'content' => 'nullable|min:3|max:200',
            'description' => 'nullable|min:3|max:200',
            'user_name' => 'required|min:3|max:49',
            'status' => Rule::in(['status1', 'status2', 'status3']),
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        Task::create(request()->all());

        return redirect()->route('task.index');
    }



    public function update(Task $task)
    {   
        return view('tasks.create', ['task'=>$task]);
    }


    public function edit(Request $request,Task $task)
    {
        request()->validate([
            'name' => 'required|min:3|max:49',
            'screen_name' => 'required|min:3|max:49',
            'content' => 'nullable|min:3|max:200',
            'description' => 'nullable|min:3|max:200',
            'user_name' => 'required|min:3|max:49',
            'status' => Rule::in(['status1', 'status2', 'status3']),
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $task->update(request()->all());
        
        return redirect()->route('task.index');

    }

    public function destroy(Task $task)
    {
        $task->delete();

        if(request()->expectsJson())
        {    
            return response('', 404);
        }
    }

    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    
}
