<?php

namespace App\Http\Controllers;

use App\Http\Resources\Task as TaskRsource;
use App\Task;
use Illuminate\Http\Request;
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
  
        
        $tasks = Task::paginate(10);
        return response()->json($tasks);
     
        
    }

    public function create()
    {
        return view('tasks.create');
    }

    
}
