@extends('layouts.app')
@section('title', 'Register')
@section('content')

<h1>Register</h1>
<form action="{{ route('register.submit') }}" method="POST">
    @csrf
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus autocomplete="username">
    </div>
    
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required autocomplete="new-password">
        @error('password') <p>{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
        @error('password_confirmation') <p>{{ $message }}</p> @enderror
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
    @endsection