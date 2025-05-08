@extends('layouts.app')

@section('content')

<style>
    /* Main Container - Enhanced with gradient border */
    .landing-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        overflow: hidden;
    }

    .landing-container::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(135deg, #3498db, #9b59b6);
        z-index: -1;
        border-radius: 18px;
        opacity: 0.7;
    }

    /* Header - More elegant typography */
    .landing-container h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
        font-size: 32px;
        font-weight: 700;
        letter-spacing: -0.5px;
        position: relative;
        padding-bottom: 15px;
    }

    .landing-container h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #3498db, #9b59b6);
        border-radius: 2px;
    }

    /* Form Elements - More refined */
    .landing-container form {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .landing-container label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: #34495e;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .landing-container input {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #e0e6ed;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: #fff;
    }

    .landing-container input:hover {
        border-color: #b8c2cc;
    }

    .landing-container input:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
        outline: none;
        background-color: #ffffff;
    }

    /* Button - More prominent with gradient */
    .landing-container button {
        background: linear-gradient(135deg, #3498db, #9b59b6);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-top: 15px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 6px rgba(52, 152, 219, 0.15);
    }

    .landing-container button:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(52, 152, 219, 0.2);
    }

    .landing-container button:active {
        transform: translateY(0);
    }

    /* Register Link - More subtle */
    .register-link {
        text-align: center;
        margin-top: 30px;
        color: #64748b;
        font-size: 14px;
    }

    .register-link a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
        position: relative;
        transition: all 0.3s ease;
    }

    .register-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: currentColor;
        transition: width 0.3s ease;
    }

    .register-link a:hover {
        color: #2980b9;
    }

    .register-link a:hover::after {
        width: 100%;
    }

    /* Error Messages - More refined */
    .error-message {
        background: #fff5f5;
        color: #dc3545;
        padding: 14px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-size: 14px;
        border-left: 4px solid #dc3545;
        animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }

    .error-message p {
        margin: 5px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .error-message p::before {
        content: '⚠';
        font-size: 16px;
    }

    /* Animation */
    @keyframes shake {
        10%, 90% { transform: translateX(-1px); }
        20%, 80% { transform: translateX(2px); }
        30%, 50%, 70% { transform: translateX(-3px); }
        40%, 60% { transform: translateX(3px); }
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .landing-container {
            margin: 30px 20px;
            padding: 25px;
        }
        
        .landing-container h1 {
            font-size: 28px;
        }
    }
</style>
<div class="landing-container">
    <h1>Welcome to Our System</h1>
    
    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        <p>New user? <a href="{{ route('register') }}">Create account</a></p>
    </div>
</div>
@endsection