<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;
use Cart;

class ShoppingController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();

        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $request->quantity
        ]);

        Cart::associate($cartItem->rowId, 'App\Models\Product');
        Session::flash('success', 'Product add to cart successfully!');
        
        return redirect()->route('cart');
    }

    public function cart()
    {
        $title = 'Cart';

        return view('frontend.cart')->with(compact('title'));
    }

    public function delete($id)
    {
        Cart::remove($id);
        Session::flash('error', 'Product remove from cart successfully!');

        return redirect()->back();
    }

    public function decrement($id, $qty)
    {
        Cart::update($id, $qty - 1);
        Session::flash('success', 'Product quantity minus by 1 successfully!');

        return redirect()->back();
    }

    public function increment($id, $qty)
    {
        Cart::update($id, $qty + 1);
        Session::flash('success', 'Product quantity add by 1 successfully!');

        return redirect()->back();
    }
}
