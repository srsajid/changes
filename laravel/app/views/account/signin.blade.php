@extends('layout.main')

@section('content')
    <form action="{{URL::route('sign-in-post')}}" method="post">
        <div class="glyphicon-log-in">
            Email:<input type="text" name="username" {{(Input::old('username')) ?' value = "'. (Input::old('username')).'"' :'' }}>
            @if($errors->has('username'))
                {{$errors->first('username')}}
            @endif
        </div>
        <div class="glyphicon-log-in">
            Password:<input type="password" name="password">
            @if($errors->has('password'))
                {{$errors->first('password')}}
            @endif
        </div>
        <input type="submit" value="Sign in">
        {{Form::token()}}
    </form>
@stop