<?php

namespace App\Http\Controllers;

use App\Models\Product_In;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductInController extends Controller
{
    public function index()
    {
        $productIns = Product_In::with('product')->get();
        $products = Product::all();
        
        return view('products.productin', compact('productIns', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'prin_quantity' => 'required|numeric|min:1',
            'prin_date' => 'required|date',
            'unit_price' => 'required|numeric|min:0.01',
        ]);

        $productIn = Product_In::create([
            'product_id' => $request->product_id,
            'prin_quantity' => $request->prin_quantity,
            'prin_date' => $request->prin_date,
            'unit_price' => $request->unit_price,
        ]);

        return redirect()->route('productin.index')->with('success', 'Inventory record added successfully');
    }

    public function edit($id)
    {
        $productIn = Product_In::findOrFail($id);
        $products = Product::all();
        return view('edit_productin', compact('productIn', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'prin_quantity' => 'required|numeric|min:1',
            'prin_date' => 'required|date',
            'unit_price' => 'required|numeric|min:0.01',
        ]);

        $productIn = Product_In::findOrFail($id);
        $productIn->update($request->all());

        return redirect()->route('productin.index')->with('success', 'Inventory record updated successfully');
    }

    public function destroy($id)
    {
        $productIn = Product_In::findOrFail($id);
        $productIn->delete();

        return redirect()->route('productin.index')->with('success', 'Inventory record deleted successfully');
    }
}