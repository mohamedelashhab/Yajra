@extends('layouts.app')


@section('content')

        <legend>Show Task</legend>

        <div class="form-group">
            <label for="">Name:</label>
            <input type="text" name="name" value="{{$task?$task->name:''}}" class="form-control" id="name" disabled>
        </div>
    
        <div class="form-group">
            <label for="screen_name">screen name:</label>
            <input type="text" name="screen_name"  value="{{$task?$task->screen_name:''}}" class="form-control" id="screen_name" disabled>
        </div>
    
        <div class="form-group">
            <label for="user_name">user name:</label>
            <input type="text" name="user_name" value="{{$task?$task->user_name:''}}"  class="form-control" id="user_name" disabled>
        </div>
    
        <div class="form-group">
            <textarea name="content" id="content" class="form-control" rows="3" disabled>"{{$task?$task->content:''}}"</textarea>
        </div>

        <div class="form-group">
                <textarea name="description" id="description" class="form-control" rows="3" disabled>"{{$task?$task->description:''}}"</textarea>
        </div>

        <div class="form-group">
                <input type="file" name="image" value="{{$task?$task->image:''}}"  class="form-control" disabled>
        </div>
    
        
        <select name="statuse" id="statuse" class="form-control" required="required" disabled>
            @foreach (['statuse1', 'statuse2', 'statuse3'] as $item)
                <option value="{{$item}}" {{$item==$task->statuse?'checked':''}}>{{$item}}</option>
            @endforeach
        </select>
        
        
    </form>

    <a href="{{ route('task.index') }}"> Back </a>
@endsection




