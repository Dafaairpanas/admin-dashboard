<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force URL scheme based on environment
        if (config('app.env') === 'local') {
            URL::forceScheme('http');
        } else {
            URL::forceScheme('https');
        }
        // Share available languages to all views (for Topbar, etc)
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('languages')) {
                \Illuminate\Support\Facades\View::share('available_languages', \App\Models\Languages::where('is_active', 1)->get());
            }

            // Share dynamic menu to sidebar
            if (\Illuminate\Support\Facades\Schema::hasTable('menus')) {
                $menus = \App\Models\Menu::whereNull('parent_id')
                    ->orderBy('urutan', 'asc')
                    ->get();
                \Illuminate\Support\Facades\View::composer('layouts.partials.startbar', function ($view) use ($menus) {
                    $view->with('management_menus', $menus);
                });
            }
        } catch (\Exception $e) {
            // Fallback if DB not ready
        }
    }
}
