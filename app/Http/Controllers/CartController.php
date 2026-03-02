<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product.mainImage')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function addProduct(Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()
            ->with('toast_message', 'Producto añadido al carrito')
            ->with('toast_type', 'success');
    }

    public function deleteProduct(Request $request)
    {
        Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();

        return redirect()->route('cart.index')
            ->with('toast_message', 'Producto eliminado del carrito')
            ->with('toast_type', 'success');
    }
}
