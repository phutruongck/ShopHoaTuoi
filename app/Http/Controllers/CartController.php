<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Cart;
use App\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('product.cart');
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function getCart()
    {
        if(!Session::has('cart')) {
            return response()->json([
                'status' => 'error',
                'data' => [
                    'products' => null
                ]
            ]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return response()->json([
            'status' => 'success',
            'data' => [
                'products' => $cart->items,
                'totalPrice' => $cart->totalPrice
            ]
        ]);
    }

    public function getSubToCart(Request $request, $id, $qty)
    {
        $product = Product::find($id);
        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);

        $cart->sub($product, $product->id, $qty);
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }
}
