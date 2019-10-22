@extends('layouts.app')


@section('content')

        <legend>Show Task</legend>

        <div class="">
                <img src='{{ asset("uploads/images/$task->image") }}' alt=' {{ asset("uploads/images/$task->image") }}'>
        </div>

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
                <label for="content">content:</label>
            <textarea name="content" id="content" class="form-control" rows="3" disabled>"{{$task?$task->content:''}}"</textarea>
        </div>

        <div class="form-group">
                <label for="description">description:</label>
                <textarea name="description" id="description" class="form-control" rows="3" disabled>"{{$task?$task->description:''}}"</textarea>
        </div>
        
        
      
        
        <select name="statuse" id="statuse" class="form-control" required="required" disabled>
                <label for="statuse">statuse:</label>
            @foreach (['statuse1', 'statuse2', 'statuse3'] as $item)
                <option value="{{$item}}" {{$item==$task->statuse?'selected':''}}>{{$item}}</option>
            @endforeach
        </select>
        
    </form>

    <a href="{{ route('task.index') }}"> Back </a>
@endsection




