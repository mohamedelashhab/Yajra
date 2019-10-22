<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUpload;
use App\Http\Resources\Task as TaskRsource;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\JsonResponse;
use Yajra\Datatables\Datatables;


class TaskController extends Controller
{

    use FileUpload;
    public function index()
    {   
        return view('tasks.index');
    }

    public function list()
    {
    
        $tasks = Task::query();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
        $filterBy = (!empty($_GET["filterBy"])) ? ($_GET["filterBy"]) : ('');
        $sortType = (!empty($_GET["sortType"])) ? ($_GET["sortType"]) : ('DESC');

        
        
        if($start_date && $end_date){
            $start_date = Carbon::parse($start_date);
            $end_date = Carbon::parse($end_date);
            $tasks = $tasks->whereNull('deleted_at')->whereDate('created_at','>=',$start_date);
            $tasks->whereDate('created_at', '<=', $end_date);
        }
        if($filterBy)
        {
            $tasks->orderBy($filterBy, $sortType);
        }
        
        else{
            $tasks = $tasks->where('deleted_at', NULL);
        }

        

        return datatables()->of($tasks)
            ->make(true);
 
        
    }

    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|min:1|max:49',
            'screen_name' => 'required|min:1|max:49',
            'content' => 'nullable|min:1|max:200',
            'description' => 'nullable|min:1|max:200',
            'user_name' => 'required|min:1|max:49',
            'status' => Rule::in(['status1', 'status2', 'status3']),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_name = $this->saveFiles(request()->file('image'), 'images');
        $request['image'] = $image_name;
        // dd($request->all());
        $task = Task::create($request->all());
        
        $task->image = $image_name;
        // dd($task);
        $task->save();

        return redirect()->route('task.index');
    }



    public function update(Task $task)
    {   
        return view('tasks.create', ['task'=>$task]);
    }


    public function edit(Request $request,Task $task)
    {
        if($task->image){
            $request->image = $task->image;
        }
        request()->validate([
            'name' => 'required|min:1|max:49',
            'screen_name' => 'required|min:1|max:49',
            'content' => 'nullable|min:1',
            'description' => 'nullable|min:1',
            'user_name' => 'required|min:1|max:49',
            'status' => Rule::in(['status1', 'status2', 'status3']),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
