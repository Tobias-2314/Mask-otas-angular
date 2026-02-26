<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CartHelper
{
    protected function getCartKey()
    {
        if (Auth::check()) {
            return 'cart_user_' . Auth::id();
        }
        return 'cart_guest';
    }

    protected function getCart()
    {
        return session()->get($this->getCartKey(), []);
    }

    protected function getCartCount()
    {
        return count($this->getCart());
    }
}
