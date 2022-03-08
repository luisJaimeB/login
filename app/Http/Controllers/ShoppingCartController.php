<?php

namespace App\Http\Controllers;

use App\Constants\PaymentGateways;
use App\Models\ShoppingCart;
use App\Http\Requests\UpdateShoppingCartRequest;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        $gateways = (new PaymentGateways())->toArray();

        return view('products.cart', compact('gateways'));
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::whereName($request->name)->firstOrFail();

        Cart::add($product->id, $product->name, $product->quantity, $product->price);

        return back();
    }

    public function destroy()
    {
        Cart::destroy();

        return redirect()->route('products.index');
    }
}
