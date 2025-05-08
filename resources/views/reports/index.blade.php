@extends('layouts.app')

@section('content')

<a href="{{route('dashboard')}}" class="back-link">
    <span class="back-arrow">←</span> Back to Dashboard
</a>

<div class="reports-container">
    <div class="reports-header">
        <h1>Daily Stock Reports</h1>
        <div class="date-filter">
            <form action="{{ route('reports.index') }}" method="GET" class="filter-form">
                <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" class="form-input">
                <button type="submit" class="filter-btn">Filter</button>
            </form>
        </div>
    </div>

    <div class="reports-content">

        <div class="report-card">
            <h2>Stock In Summary</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Value</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockIns as $stockIn)
                        <tr>
                            <td>{{ $stockIn->product->product_name }}</td>
                            <td>{{ $stockIn->prin_quantity }}</td>
                            <td>${{ number_format($stockIn->unit_price, 2) }}</td>
                            <td>${{ number_format($stockIn->prin_quantity * $stockIn->unit_price, 2) }}</td>
                            <td>{{ $stockIn->prin_date }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No stock in records for this date</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total Stock In Value</strong></td>
                            <td colspan="2"><strong>${{ number_format($totalStockInValue, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Stock Out Summary -->
        <div class="report-card">
            <h2>Stock Out Summary</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockOuts as $stockOut)
                        <tr>
                            <td>{{ $stockOut->product->product_name }}</td>
                            <td>{{ $stockOut->prout_quantity }}</td>
                            <td>{{ $stockOut->prout_date }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No stock out records for this date</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total Items Removed</strong></td>
                            <td><strong>{{ $totalStockOutQuantity }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .back-link {
        display: inline-block;
        padding: 10px 20px;
        margin-bottom: 20px;
        color:rgb(255, 255, 255);
        text-decoration: none;
        font-weight: 500;
        border-radius: 6px;
        background-color:rgb(47, 138, 230);
        transition: all 0.3s ease;
    }

    .back-link:hover {
        background-color: #e9ecef;
        transform: translateX(-5px);
        color:rgb(14, 7, 7);
    }

    .back-arrow {
        margin-right: 8px;
    }

    .reports-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .reports-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .reports-header h1 {
        margin: 0;
        color: #2c3e50;
    }

    .date-filter {
        display: flex;
        gap: 10px;
    }

    .filter-form {
        display: flex;
        gap: 10px;
    }

    .form-input {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .filter-btn {
        padding: 8px 16px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .filter-btn:hover {
        background-color: #2980b9;
    }

    .reports-content {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .report-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 20px;
    }

    .report-card h2 {
        margin: 0 0 20px 0;
        color: #2c3e50;
        font-size: 1.5rem;
    }

    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #2c3e50;
    }

    tfoot tr {
        background-color: #f8f9fa;
    }

    tfoot td {
        font-weight: 600;
    }

    .text-center {
        text-align: center;
    }

    @media (max-width: 768px) {
        .reports-header {
            flex-direction: column;
            gap: 15px;
        }

        .date-filter {
            width: 100%;
        }

        .filter-form {
            width: 100%;
        }

        .form-input {
            flex: 1;
        }
    }
</style>
@endsection 