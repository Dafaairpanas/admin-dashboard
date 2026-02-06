<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (!auth()->check()) {
                return;
            }

            $user = auth()->user();
            $roleUser = $user->refRoleUser;

            if (!$roleUser) {
                $view->with('menus', collect([]));
                return;
            }

            $roleId = $roleUser->role_id;

            // Ambil parent menu yang memiliki minimal satu child dengan permission read
            // Child menu yang disimpan di role_menu adalah menu clickable (yang punya parent_id)
            $menus = Menu::with([
                'manyChild' => function ($q) use ($roleId) {
                    $q->whereHas('refRoleMenu', function ($rm) use ($roleId) {
                        $rm->where('role_id', $roleId)->where('read', 1);
                    })
                        ->orderBy('urutan');
                }
            ])
                ->whereNull('parent_id') // Ambil parent menu (label sidebar)
                ->whereHas('manyChild.refRoleMenu', function ($rm) use ($roleId) {
                    // Parent tampil jika punya child dengan permission read
                    $rm->where('role_id', $roleId)->where('read', 1);
                })
                ->orderBy('urutan')
                ->get();

            $view->with('menus', $menus);
        });
    }
}
