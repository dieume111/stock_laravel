@extends('layouts.app')
@section('title', 'Login')
@section('content')
 
<h1>Login in</h1>
<form action="{{route('login.submit')}}" method="POST">
@csrf
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus autocomplete="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required autocomplete="current-password">
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
    @endsection