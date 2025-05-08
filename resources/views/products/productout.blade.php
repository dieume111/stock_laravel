@extends('layouts.app')

@section('content')
<div class="inventory-removal">
    <div class="removal-header">
        <a href="{{ route('productin.index') }}" class="back-btn">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 8H1M8 15L1 8L8 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Back to Inventory
        </a>
        <h1 class="page-title">Inventory Removal</h1>
    </div>

    <div class="removal-content">
        <!-- Removal Form -->
        <div class="removal-card">
            <div class="card-header">
                <h2>Remove Product from Inventory</h2>
                <p class="card-subtitle">Enter the product removal details below</p>
            </div>
            
            <form action="{{ route('productout.store') }}" method="post" class="removal-form">
                @csrf
                <div class="form-group">
                    <label for="product_id">Select Product</label>
                    <select name="product_id" id="product_id" class="form-input">
                        <option value="">Select a product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->product_name }} (Available: {{ $product->stock }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="prout_quantity">Quantity to Remove</label>
                    <input type="number" name="prout_quantity" id="prout_quantity" placeholder="Enter quantity" class="form-input" required min="1">
                </div>
                
                <div class="form-group">
                    <label for="prout_date">Removal Date</label>
                    <input type="date" name="prout_date" id="prout_date" class="form-input" required value="{{ date('Y-m-d') }}">
                </div>
                
                <button type="submit" name="add_productout" class="submit-btn remove-btn">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 4H14M5 4V2C5 1.44772 5.44772 1 6 1H10C10.5523 1 11 1.44772 11 2V4M13.5 4V14C13.5 14.5523 13.0523 15 12.5 15H3.5C2.94772 15 2.5 14.5523 2.5 14V4H13.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Remove from Inventory
                </button>
            </form>
        </div>

        <!-- Removal Records -->
        <div class="records-card">
            <div class="card-header">
                <h2>Product Removal Records</h2>
            </div>
            
            <div class="records-table">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity Removed</th>
                            <th>Date</th>
                            <th>Actions</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productOuts as $productOut)
                        <tr>
                            <td>{{ $productOut->product->product_name }}</td>
                            <td>{{ $productOut->prout_quantity }}</td>
                            <td>{{ $productOut->prout_date }}</td>
                            <td class="actions">
                                <a href="{{ route('productout.edit', $productOut->prout_id) }}" class="action-btn edit-btn">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.5 1.5L12.5 5.5M1 13L4.5 12.5L12 5L9 2L1.5 9.5L1 13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <form action="{{ route('productout.destroy', $productOut->prout_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 4H12M5 4V2C5 1.44772 5.44772 1 6 1H8C8.55228 1 9 1.44772 9 2V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Base Styles */
    .inventory-removal {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .removal-header {
        margin-bottom: 30px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 0;
    }

    .back-btn svg {
        width: 16px;
        height: 16px;
    }

    .back-btn:hover {
        text-decoration: underline;
    }

    .page-title {
        font-size: 28px;
        margin: 10px 0 0;
        color: #111;
    }

    .removal-content {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* Card Styles */
    .removal-card, .records-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header {
        padding: 18px 25px;
        border-bottom: 1px solid #f0f0f0;
    }

    .card-header h2 {
        margin: 0;
        font-size: 20px;
        color: #222;
    }

    .card-subtitle {
        margin: 5px 0 0;
        color: #666;
        font-size: 14px;
    }

    /* Form Styles */
    .removal-form {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 14px;
        color: #444;
    }

    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    select.form-input {
        appearance: none;
        background-image: url
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px 12px;
    }

    /* Button Styles */
    .submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .remove-btn {
        background-color: #ef4444;
        color: white;
        width: 100%;
    }

    .remove-btn:hover {
        background-color: #dc2626;
    }

    .remove-btn svg {
        width: 16px;
        height: 16px;
    }

    /* Table Styles */
    .records-table {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #f8fafc;
        padding: 14px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        color: #444;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        padding: 14px 20px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
    }

    tr:hover td {
        background-color: #f9fafb;
    }

    /* Action Buttons */
    .actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        background: transparent;
    }

    .action-btn svg {
        width: 14px;
        height: 14px;
    }

    .edit-btn {
        color: #3b82f6;
    }

    .edit-btn:hover {
        background-color: #e0e7ff;
    }

    .delete-btn {
        color: #ef4444;
    }

    .delete-btn:hover {
        background-color: #fee2e2;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .removal-form {
            padding: 20px;
        }
        
        th, td {
            padding: 12px 15px;
        }
    }
</style>
@endsection