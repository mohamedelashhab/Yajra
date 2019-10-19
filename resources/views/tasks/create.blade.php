@extends('layouts.app')


@section('content')
@if (!empty($task))
    <form action="{{route('task.edit', $task->id)}}" method="POST" role="form" enctype="multipart/form-data">
    @method('put')
@else
    <form action="{{route('task.store')}}" method="POST" role="form" enctype="multipart/form-data">
@endif
        @csrf
        <legend>Create Task</legend>
        @if(!empty($task))
            <div class="">
                    <img src='{{ asset("uploads/images/$task->image") }}' alt=' {{ asset("uploads/images/$task->image") }}'>
            </div>
        @endif
        <div class="form-group">
                <label for="image">image:</label>
                    <input type="file" name="image" value="{{ asset('uploads/images/'.$task->image)??''}}"  class="form-control">
        </div>

        <div class="form-group">
            <label for="">Name:</label>
            <input type="text" name="name" value="{{$task->name??old('name')}}" class="form-control" id="name" required>
        </div>
    
        <div class="form-group">
            <label for="screen_name">screen name:</label>
            <input type="text" name="screen_name"  value="{{$task->screen_name??old('screen_name')}}" class="form-control" id="screen_name" required>
        </div>
    
        <div class="form-group">
            <label for="user_name">user name:</label>
            <input type="text" name="user_name" value="{{$task->user_name??old('user_name')}}"  class="form-control" id="user_name" required>
        </div>
    
        <div class="form-group">
            <label for="content">description</label>
            <textarea name="content" id="content" class="form-control" rows="3">{{$task->content??old('content')}}</textarea>
        </div>

        <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{$task->description??old('description')}}</textarea>
        </div>

        
    
        <label for="statuse">statuse:</label>
        <select name="statuse" id="statuse" class="form-control" required="required">
            @foreach (['statuse1', 'statuse2', 'statuse3'] as $item)
                <option value="{{$item}}" {{ !empty($task) && $item==$task->statuse  ?'checked':'' }}>{{$item}}</option>
            @endforeach
        </select>
        
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif
@endsection




