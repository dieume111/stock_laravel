<?php

namespace App\Http\Controllers;

use App\Models\Product_Out;
use App\Models\Product;
use App\Models\Product_In;
use Illuminate\Http\Request;

class ProductOutController extends Controller
{
    public function index()
    {
        $productOuts = Product_Out::with('product')->latest()->get();
        $products = Product::all();
        return view('products.productout', compact('productOuts', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('productout.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'prout_quantity' => 'required|numeric|min:1',
            'prout_date' => 'required|date'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check if there's enough stock
        if ($product->stock < $request->prout_quantity) {
            return back()->with('error', 'Insufficient stock available. Available stock: ' . $product->stock);
        }

        // Create the product out record
        $productOut = Product_Out::create([
            'product_id' => $request->product_id,
            'prout_quantity' => $request->prout_quantity,
            'prout_date' => $request->prout_date
        ]);

        // Update product stock
        $product->stock -= $request->prout_quantity;
        $product->save();

        return redirect()->route('productout.index')->with('success', 'Product out recorded successfully');
    }

    public function show(Product_Out $productout)
    {
        return view('productout.show', compact('productout'));
    }

    public function edit(Product_Out $productout)
    {
        $products = Product::all();
        return view('productout.edit', compact('productout', 'products'));
    }

    public function update(Request $request, Product_Out $productout)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'prout_quantity' => 'required|numeric|min:1',
            'prout_date' => 'required|date'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Calculate the difference in quantity
        $oldQuantity = $productout->prout_quantity;
        $newQuantity = $request->prout_quantity;
        $difference = $newQuantity - $oldQuantity;

        // Check if there's enough stock for the new quantity
        if ($difference > 0 && $product->stock < $difference) {
            return back()->with('error', 'Insufficient stock available for the new quantity');
        }

        // Update product stock
        $product->stock -= $difference;
        $product->save();
        
        // Update the product out record
        $productout->update($request->all());

        return redirect()->route('productout.index')->with('success', 'Product out updated successfully');
    }

    public function destroy(Product_Out $productout)
    {
        // Get the product and restore its stock
        $product = Product::findOrFail($productout->product_id);
        $product->stock += $productout->prout_quantity;
        $product->save();

        // Delete the product out record
        $productout->delete();
        
        return redirect()->route('productout.index')->with('success', 'Product out deleted successfully');
    }

    public function getProductInData()
    {
        $productIns = Product_In::with('product')->latest()->get();
        return view('productout.productin', compact('productIns'));
    }
}
