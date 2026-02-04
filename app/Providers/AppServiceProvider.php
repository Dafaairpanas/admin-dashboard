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
        // Share available languages to all views (for Topbar, etc)
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('languages')) {
                \Illuminate\Support\Facades\View::share('available_languages', \App\Models\Languages::where('is_active', 1)->get());
            }
        } catch (\Exception $e) {
            // Fallback if DB not ready
        }
    }
}
