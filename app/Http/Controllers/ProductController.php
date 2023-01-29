<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::get();
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Add product to user's cart
     * 
     */
    public function add_to_cart(Request $request, Product $product)
    {
        $item = UserCart::where('product_id', $product->id)
                                ->where('user_id', $request->user()->id)
                                ->first();

        // Check if there is already same item in cart, then add quantity by 1.
        if ($item) {
            $item->increment('quantity');
        } else {
            // If item does not exist, add to cart
            UserCart::create([
                'product_id' => $product->id,
                'user_id' => $request->user()->id,
                'quantity' => 1
            ]);
        }
        
        return redirect()->route('products');
    }
}
