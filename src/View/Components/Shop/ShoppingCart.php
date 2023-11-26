<?php

namespace Sitebrew\View\Components\Shop;

use Illuminate\View\Component;
use Sitebrew\Models\Shop\Product;

class ShoppingCart extends Component
{
    public $cart = [];

    public $cartItemsAmount = 0;

    public $total = 0;

    public $includesSubscription = false;

    public $includesShipping = false;

    public $disabled = false;

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->setCart();

        return view('sitebrew::components.shop.shopping-cart');
    }

    public function setCart()
    {
        $cart = collect(request()->session()->get('cart', []));
        if ($cart->count()) {
            $this->cart = Product::whereIn('id', $cart->keys())->withMediaAndVariants(['media'])->get();

            if ($this->cart) {
                foreach ($this->cart as $item) {
                    $item->amount = $cart->get($item->id);
                    $this->cartItemsAmount = $this->cartItemsAmount + $item->amount;
                    $this->total = $this->total + ($item->price * $item->amount);
                    if ($item->billing_type === 'subscription') {
                        $this->includesSubscription = true;
                    }
                    if ($item->shipping) {
                        $this->includesShipping = true;
                    }
                }
                if ($this->includesShipping && $this->includesSubscription) {
                    $this->disabled = true;
                }
            }
        }
    }
}
