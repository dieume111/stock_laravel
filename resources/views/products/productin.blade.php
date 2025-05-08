@extends('layouts.app')

@section('content')
<div class="inventory-wrapper">
    <div class="inventory-nav">
        <a href="{{ route('dashboard') }}" class="back-link">← Back to Inventory</a>
    </div>

    <div class="inventory-content">
        <div class="inventory-card">
            <h2>Add New Inventory Record</h2>
            <p class="card-description">Enter the inventory details below</p>
            
            <form action="{{ route('productin.store') }}" method="post" class="inventory-form">
                @csrf
                <div class="form-group">
                    <select name="product_id" id="product_id" class="form-input">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <input type="number" name="prin_quantity" placeholder="Quantity" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <input type="number" step="0.01" name="unit_price" placeholder="Unit price" class="form-input" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <input type="date" name="prin_date" class="form-input" required>
                </div>
                
                <button type="submit" name="add_productin" class="submit-btn">Add Record</button>
            </form>
        </div>

        <!-- Inventory Records Section -->
        <div class="inventory-card">
            <h2>Inventory Records</h2>
            
            <div class="records-table">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Date</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th>Actions</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productIns as $productIn)
                        <tr>
                            <td>{{ $productIn->product->product_name }}</td>
                            <td>{{ $productIn->prin_quantity }}</td>
                            <td>{{ $productIn->prin_date }}</td>
                            <td>{{ $productIn->unit_price }}</td>
                            <td>{{ number_format($productIn->prin_quantity * $productIn->unit_price, 2) }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('productin.edit', $productIn->prin_id) }}" class="edit-btn">Edit</a>
                                <form action="{{ route('productin.destroy', $productIn->prin_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
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
    .inventory-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }
    
    .inventory-nav {
        margin-bottom: 25px;
    }
    
    .back-link {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }
    
    .back-link:hover {
        text-decoration: underline;
    }
    
    .inventory-content {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    /* Card Styles */
    .inventory-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 25px;
    }
    
    .inventory-card h2 {
        margin-top: 0;
        margin-bottom: 10px;
        color: #333;
        font-size: 1.4rem;
    }
    
    .card-description {
        color: #666;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }
    
    /* Form Styles */
    .inventory-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .form-row {
        display: flex;
        gap: 15px;
    }
    
    .form-row .form-group {
        flex: 1;
    }
    
    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.95rem;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }
    
    .submit-btn {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.95rem;
        transition: background 0.2s;
    }
    
    .submit-btn:hover {
        background: #2563eb;
    }
    
    /* Table Styles */
    .records-table {
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    
    th {
        background: #f3f4f6;
        padding: 12px 15px;
        text-align: left;
        font-weight: 500;
        color: #444;
    }
    
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
    }
    
    tr:hover td {
        background: #f9fafb;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .edit-btn, .delete-btn {
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 0.85rem;
        text-decoration: none;
        cursor: pointer;
    }
    
    .edit-btn {
        background: #e0e7ff;
        color: #3b82f6;
        border: none;
    }
    
    .edit-btn:hover {
        background: #d0d9ff;
    }
    
    .delete-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
    }
    
    .delete-btn:hover {
        background: #fecaca;
    }
</style>
@endsection