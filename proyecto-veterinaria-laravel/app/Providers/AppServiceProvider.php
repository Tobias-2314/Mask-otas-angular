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
    }
}
