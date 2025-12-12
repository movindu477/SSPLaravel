<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Pet::count();
        $totalUsers = User::count();
        $totalRevenue = Pet::sum('price');
        
        $recentProducts = Pet::orderBy('id', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('id', 'desc')->take(5)->get();
        
        return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'totalRevenue', 'recentProducts', 'recentUsers'));
    }
    
    public function products()
    {
        $products = Pet::all();
        return view('admin.products', compact('products'));
    }
    
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    
    public function createProduct()
    {
        return view('admin.create-product');
    }
    
    public function storeProduct(Request $request)
    {
        $request->validate([
            'pet_type' => 'required',
            'accessories_type' => 'required',
            'price' => 'required|numeric',
            'product_name' => 'required',
            'image_url' => 'required'
        ]);
        
        Pet::create($request->all());
        
        return redirect()->route('admin.products')->with('success', 'Product created successfully');
    }
    
    public function editProduct($id)
    {
        $product = Pet::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }
    
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'pet_type' => 'required',
            'accessories_type' => 'required',
            'price' => 'required|numeric',
            'product_name' => 'required',
            'image_url' => 'required'
        ]);
        
        $product = Pet::findOrFail($id);
        $product->update($request->all());
        
        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }
    
    public function deleteProduct($id)
    {
        $product = Pet::findOrFail($id);
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }
}

