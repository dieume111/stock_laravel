@extends('layouts.app')
@section('title', 'Products')
@section('content')

<div class="product-management">
    <div class="header">
        <h1 class="title">Product Management</h1>
        <div class="actions">
            <a href="{{route('products.create')}}" class="btn create-btn">
                <span>+</span> Create Product
            </a>
            <a href="{{route('dashboard')}}" class="btn back-btn">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td data-label="ID">{{$product->product_id}}</td>
                    <td data-label="Name">{{$product->product_name}}</td>
                    <td data-label="Price">${{number_format($product->product_price, 2)}}</td>
                    <td data-label="Stock">{{$product->stock}}</td>
                    <td class="action-cell" data-label="Actions">
                        <a href="{{route('products.edit', $product)}}" class="action-btn edit-btn">update</a>
                        <form action="{{route('products.destroy', $product)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #e6e9ff;
        --primary-dark: #3a56d4;
        --danger: #e63946;
        --danger-light: #fde8ea;
        --text: #2b2d42;
        --text-light: #6c757d;
        --light: #f8f9fa;
        --white: #ffffff;
        --gray: #e9ecef;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        --radius: 8px;
    }

    .product-management {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 20px;
    }

    .header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
    }

    .title {
        color: var(--text);
        font-size: 28px;
        font-weight: 600;
        margin: 0;
    }

    .actions {
        display: flex;
        gap: 15px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: var(--radius);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .create-btn {
        background: var(--primary);
        color: var(--white);
        border: 1px solid var(--primary);
    }

    .create-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .create-btn span {
        font-size: 18px;
    }

    .back-btn {
        background: var(--white);
        color: var(--text);
        border: 1px solid var(--gray);
    }

    .back-btn:hover {
        background: var(--light);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .table-container {
        overflow-x: auto;
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 1px;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .product-table th {
        background: var(--primary-light);
        color: var(--primary);
        padding: 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .product-table td {
        padding: 15px;
        border-bottom: 1px solid var(--gray);
        color: var(--text);
    }

    .product-table tr:last-child td {
        border-bottom: none;
    }

    .product-table tr:hover td {
        background: rgba(67, 97, 238, 0.05);
    }

    .action-cell {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .edit-btn {
        background: var(--primary-light);
        color: var(--primary);
    }

    .edit-btn:hover {
        background: var(--primary);
        color: var(--white);
    }

    .delete-btn {
        background: var(--danger-light);
        color: var(--danger);
    }

    .delete-btn:hover {
        background: var(--danger);
        color: var(--white);
    }

    /* Responsive table */
    @media (max-width: 768px) {
        .product-table {
            display: block;
        }

        .product-table thead {
            display: none;
        }

        .product-table tr {
            display: block;
            margin-bottom: 20px;
            border: 1px solid var(--gray);
            border-radius: var(--radius);
        }

        .product-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid var(--gray);
            text-align: right;
        }

        .product-table td:before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--text-light);
            margin-right: 15px;
        }

        .product-table td:last-child {
            border-bottom: none;
        }

        .action-cell {
            justify-content: flex-end;
        }
    }
</style>

@endsection