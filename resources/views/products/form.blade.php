@extends('layouts.app')
@section('title', 'Fill the Form')   
@section('content')

<div class="form-container">
    <a href="{{ route('products.index') }}" class="back-link">
        <span class="back-arrow">←</span> Back to Products
    </a>
    <div class="form-card">
        <h2 class="form-title">{{isset($product) ? 'Update Product' : 'Create Product'}}</h2>
        
        <form class="product-form" action="{{isset($product) ? route('products.update', $product) : route('products.store')}}" method="POST">
            @csrf
            @if(isset($product))
                @method('PUT')
                <input type="hidden" name="product_id" value="{{$product->product_id}}">
            @endif

            <div class="form-group">
                <input type="text" name="product_name" id="product_name" 
                       value="{{old('product_name', $product->product_name ?? '')}}" 
                       required autofocus autocomplete="product_name">
                <label for="product_name">Product Name</label>
                <span class="focus-border"></span>
            </div>

            <div class="form-group">
                <input type="number" name="product_price" id="product_price" 
                       value="{{old('product_price', $product->product_price ?? '')}}" 
                       required autocomplete="product_price">
                <label for="product_price">Product Price ($)</label>
                <span class="focus-border"></span>
            </div>

            <div class="form-group">
                <input type="text" name="stock" id="stock" 
                       value="{{old('stock', $product->stock ?? '')}}" 
                       required autocomplete="stock">
                <label for="stock">Stock Quantity</label>
                <span class="focus-border"></span>
            </div>

            <button type="submit" class="submit-btn">
                {{isset($product) ? 'Update' : 'Create'}}
                <span class="arrow">→</span>
            </button>
        </form>
    </div>
</div>

<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --text: #2b2d42;
        --light: #f8f9fa;
        --white: #ffffff;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text);
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 20px;
        padding: 10px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        background-color: var(--blue);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(67, 97, 238, 0.1);
    }

    .back-link:hover {
        background-color: var(--primary);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        border-color: var(--primary);
    }

    .back-link:active {
        transform: translateY(0);
    }

    .back-arrow {
        font-size: 20px;
        transition: transform 0.3s ease;
    }

    .back-link:hover .back-arrow {
        transform: translateX(-4px);
    }

    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: calc(100vh - 100px);
        padding: 20px;
        background-color: var(--light);
    }

    .form-card {
        width: 100%;
        max-width: 500px;
        padding: 40px;
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow);
        transition: transform 0.3s ease;
    }

    .form-card:hover {
        transform: translateY(-5px);
    }

    .form-title {
        color: var(--text);
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        font-weight: 600;
    }

    .product-form {
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
        color: var(--text);
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
        color: var(--primary);
    }

    .focus-border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--primary);
        transition: width 0.3s ease;
    }

    .form-group input:focus ~ .focus-border {
        width: 100%;
    }

    .submit-btn {
        padding: 12px 24px;
        background: var(--primary);
        color: var(--white);
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }

    .submit-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .arrow {
        transition: transform 0.3s ease;
    }

    .submit-btn:hover .arrow {
        transform: translateX(3px);
    }
</style>

@endsection