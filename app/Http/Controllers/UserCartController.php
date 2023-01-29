<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\UserCart;
use Illuminate\Http\Request;

class UserCartController extends Controller
{
    /**
     * Get the list of items in user cart
     * 
     */
    public function index(Request $request)
    {
        // Redirect to products if there is nothing in cart
        if ($request->user()->shopping_cart->count() == 0)
        {
            return redirect()->route('products');
        }

        // Count how many coupons the user will get from this purchase
        $coupons = 0;

        // Total price
        $total = 0;

        $items = $request->user()->shopping_cart()->with('product')->get();

        foreach ($items as $item) {
            // Add one coupon for every product above 50K
            if ($item->product->price > 50000) {
                $coupons++;
            }

            // Add up total price
            $total += $item->product->price * $item->quantity;
        }

        // Add one coupon for every 100K increment in total price
        $coupons += intval($total / 100000);

        return view('summary.index', [
            'items' => $items,
            'coupons' => $coupons,
            'total' => $total
        ]);
    }

    /**
     * Update quantity of cart item.
     * 
     */
    public function update_quantity(Request $request, UserCart $item)
    {
        $item->update([
            'quantity' => $request->input('quantity')
        ]);

        return back();
    }

    /**
     * Remove item from cart.
     * 
     */
    public function remove_from_cart(Request $request, UserCart $item)
    {
        $item->delete();

        return back();
    }

    /**
     * Purchase the items in cart
     * 
     */
    public function purchase(Request $request)
    {
        // Create Purchase
        $purchase = $request->user()->purchases()->create();

        $items = $request->user()->shopping_cart()->with('product')->get();

        // Initialize coupons and total variable
        $coupons = 0;
        $total = 0;

        // Create purchased products and assign to purchase
        foreach ($items as $item) {
            $purchase->products()->create([
                'product_id' => $item->product->id,
                'price' => $item->product->price,
                'quantity' => $item->quantity
            ]);

            // Add one coupon for every product above 50K
            if ($item->product->price > 50000) {
                $coupons++;
            }

            // Add up total price
            $total += $item->product->price * $item->quantity;
        }

        // Add one coupon for every 100K increment in total price
        $coupons += intval($total / 100000);

        // Update coupons column
        $request->user()->increment('coupons', $coupons);

        // Clear shopping cart
        $request->user()->shopping_cart()->delete();

        // Redirect to history page
        return redirect()->route('purchases');
    }
}
