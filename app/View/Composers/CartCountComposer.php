<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartCountComposer
{
    public function compose(View $view)
    {
        $cartCount = 0;
        
        if (Auth::check()) {
            $cart = DB::table('cart')->where('user_id', Auth::id())->first();
            if ($cart) {
                $cartCount = DB::table('cart_items')
                    ->where('cart_id', $cart->id)
                    ->sum('quantity');
            }
        }
        
        $view->with('cartCount', $cartCount);
    }
}
