<?php

namespace Sitebrew\Controllers\Shop;

use Sitebrew\Controllers\Controller;
use Sitebrew\Models\Shop\Product;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = collect(request()->session()->get('cart', []));

        $amount = $cart->get($product->id);

        if ($product->type == 'subscription') {
            $cartProducts = Product::where('billing_type', 'subscription')->whereIn('id', $cart->keys())->get();
            if ($cartProducts->isNotEmpty()) {
                foreach ($cartProducts as $cartProduct) {
                    $cart->forget($cartProduct->id);
                }
            }
        }

        if ($amount > 0 && $product->multi) {
            $cart->put($product->id, $amount + 1);
        } else {
            $cart->put($product->id, 1);
        }

        request()->session()->put('cart', $cart);

        // Add "cart" query param to open cart on redirect
        $previousUrl = strtok(url()->previous(), '?');

        return redirect()->to(
            $previousUrl.'?cart'
        );
    }

    public function remove(Product $product)
    {
        $cart = collect(request()->session()->get('cart', []));

        $cart->forget($product->id);

        request()->session()->put('cart', $cart);

        $previousUrl = strtok(url()->previous(), '?');

        return redirect()->to(
            $previousUrl.'?cart'
        );
    }
}
