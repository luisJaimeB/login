<?php

namespace App\Http\Controllers;

use App\Constants\PaymentGateways;
use App\Models\ShoppingCart;
use App\Http\Requests\UpdateShoppingCartRequest;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        $gateways = (new PaymentGateways())->toArray();

        return view('products.cart', compact('gateways'));
    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::whereId($request->id)->firstOrFail();

        Cart::add(
            $product->id,
            $product->name,
            $request->input('quantity', 1),
            $product->price
        );

        return response()->json(['count' => Cart::count()]);
    }

    public function update(string $rowId, Product $product)
    {
        Cart::update($rowId, $product);
    }

    public function remove(string $id)
    {
        Cart::remove($id);

        return response()->noContent();
    }

    public function destroy()
    {
        Cart::destroy();

        return response()->noContent();
    }

    public function increment(string $rowId): JsonResponse
    {
        $row = Cart::get($rowId);
        $qty = $row->qty;

        $product = Product::find($row->id);
        if ($row->qty < $product->quantity) {
            $qty++;
        }

        Cart::update($rowId, ['qty' => $qty]);

        return response()->json(['qty' => $qty]);
    }

    public function decrement(string $rowId): JsonResponse
    {
        $row = Cart::get($rowId);
        $qty = $row->qty;

        if ($row->qty > 1) {
            $qty--;
        }

        Cart::update($rowId, ['qty' => $qty]);

        return response()->json(['qty' => $qty]);
    }
}
