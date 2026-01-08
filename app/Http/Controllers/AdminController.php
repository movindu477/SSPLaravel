<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Access');
        }
    }

    public function index()
    {
        $this->ensureAdmin();

        $totalProducts = Pet::count();
        $totalUsers = User::count();

        // Calculate total revenue (sum of all product prices)
        $totalRevenue = Pet::sum('price');

        $recentProducts = Pet::orderBy('id', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('id', 'desc')->take(5)->get();

        return view(
            'admin.dashboard',
            compact(
                'totalProducts',
                'totalUsers',
                'totalRevenue',
                'recentProducts',
                'recentUsers'
            )
        );
    }

    public function products()
    {
        $this->ensureAdmin();

        $products = Pet::orderBy('id', 'desc')->get();
        return view('admin.products', compact('products'));
    }

    public function users()
    {
        $this->ensureAdmin();

        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function createProduct()
    {
        $this->ensureAdmin();

        return view('admin.create-product');
    }

    public function storeProduct(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'pet_type' => 'required|string|max:50',
            'accessories_type' => 'required|string|max:50',
            'product_name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|string|max:255',
        ]);

        Pet::create([
            'pet_type' => $validated['pet_type'],
            'accessories_type' => $validated['accessories_type'],
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'image_url' => $validated['image_url'],
            'created_at' => now(),
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product created successfully');
    }

    public function editProduct($id)
    {
        $this->ensureAdmin();

        $product = Pet::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'pet_type' => 'required|string|max:50',
            'accessories_type' => 'required|string|max:50',
            'product_name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|string|max:255',
        ]);

        $product = Pet::findOrFail($id);

        $product->update([
            'pet_type' => $validated['pet_type'],
            'accessories_type' => $validated['accessories_type'],
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'image_url' => $validated['image_url'],
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        $this->ensureAdmin();

        $product = Pet::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product deleted successfully');
    }

    public function createUser()
    {
        $this->ensureAdmin();
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:User,email',
            'phonenumber' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phonenumber' => $validated['phonenumber'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'created_at' => now(),
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User created successfully');
    }

    public function editUser($id)
    {
        $this->ensureAdmin();
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $this->ensureAdmin();

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:User,email,' . (int)$id,
            'phonenumber' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:user,admin',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phonenumber' => $validated['phonenumber'],
            'address' => $validated['address'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $this->ensureAdmin();

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'You cannot delete your own account');
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully');
    }

    public function profile()
    {
        $this->ensureAdmin();
        
        $user = User::findOrFail(Auth::id());
        
        return view('admin.profile', compact('user'));
    }
}
