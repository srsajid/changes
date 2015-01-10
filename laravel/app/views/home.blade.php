@extends('layout.main')

@section('content')
    @if(Auth::check())
        <p>
            Hello .
        </p>
    @else
        <p>
            Sign in first.
        </p>
    @endif
@stop