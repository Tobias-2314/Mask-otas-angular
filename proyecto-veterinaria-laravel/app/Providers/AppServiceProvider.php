<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
                \Illuminate\Support\Facades\View::share('site_settings', $settings);
            }
        } catch (\Exception $e) {
            // Ignorar error si la DB no está lista
        }

        // Compartir información del carrito globalmente
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartKey = 'cart_user_' . auth()->id();
            } else {
                $cartKey = 'cart_guest';
            }

            $cart = session()->get($cartKey, []);
            $view->with('cart', $cart);
            $view->with('cartCount', count($cart));
        });
    }
}
