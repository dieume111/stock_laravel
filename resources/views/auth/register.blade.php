@extends('layouts.app')
@section('title', 'Register')
@section('content')

<div class="register-container">
    <div class="register-card">
        <h1 class="register-title">Create Account</h1>
        
        <form action="{{ route('register.submit') }}" method="POST" class="register-form">
            @csrf
            <div class="form-group">
                <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus autocomplete="username">
                <label for="username">Username</label>
                <span class="focus-border"></span>
            </div>
            
            <div class="form-group">
                <input type="password" name="password" id="password" required autocomplete="new-password">
                <label for="password">Password</label>
                <span class="focus-border"></span>
                @error('password') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                <label for="password_confirmation">Confirm Password</label>
                <span class="focus-border"></span>
                @error('password_confirmation') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="submit-btn">Register</button>
            
            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>
</div>

<style>
    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f5f7fa;
        padding: 20px;
    }

    .register-card {
        width: 100%;
        max-width: 400px;
        padding: 40px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .register-title {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        font-weight: 600;
    }

    .register-form {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .form-group {
        position: relative;
    }

    .form-group input {
        width: 100%;
        padding: 15px 10px 5px 0;
        border: none;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
        color: #2c3e50;
        background: transparent;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-bottom-color: transparent;
    }

    .form-group label {
        position: absolute;
        top: 15px;
        left: 0;
        color: #999;
        font-size: 16px;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
        top: -10px;
        font-size: 12px;
        color: #3498db;
    }

    .focus-border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #3498db;
        transition: width 0.3s ease;
    }

    .form-group input:focus ~ .focus-border {
        width: 100%;
    }

    .error-message {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
    }

    .submit-btn {
        padding: 12px 24px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        background: #2980b9;
        transform: translateY(-2px);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #7f8c8d;
    }

    .login-link a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>

@endsection