@extends('layouts.app')

@section('title', 'Dashboard - Stock Management')

@section('content')
 <style>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
        margin: 0;
        padding: 0;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        
    }
    
    /* Navigation Bar */
    .navbar {
        background: #2c3e50;
        padding: 15px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .nav-links {
        display: flex;
        gap: 20px;
    }
    
    .nav-links a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background 0.3s;
    }
    
    .nav-links a:hover {
        background: #3498db;
    }
    
    .card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .dashboard-title {
        color: #2c3e50;
        margin: 10px 0 5px;
    }
    
    .text-light {
        color: #7f8c8d;
        margin: 0;
    }

    .table-container {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    
    th {
        background-color: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
    }
    
    tr:hover {
        background-color: #f8f9fa;
    }
    

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary {
        background-color: #3498db;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
    }
    
    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #c0392b;
    }
</style> 

<nav class="navbar">
    <div class="container">
        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('products.create') }}">Add a new Product</a>
            <a href="{{ route('productin.index') }}">Stock-in</a>
            <a href="{{ route('productout.index') }}">Stock-out</a>
            <a href="{{ route('reports.index') }}">Reports</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: rgb(247, 22, 22); font-weight: 500; cursor: pointer; padding: 8px 12px;">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card">
        <span>Welcome {{ Auth::user()->username }}</span>
        <h1 class="dashboard-title">Welcome to Stock Management System</h1>
        <p class="text-light">Manage your products efficiently</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_price}}</td>
                    <td>{{ $product->stock}}</td>
                    <td>{{ $product->Action}}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection