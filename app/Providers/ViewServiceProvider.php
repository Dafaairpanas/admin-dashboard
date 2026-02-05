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

            $roleId = auth()->user()->refRoleUser->role_id;

            $menus = Menu::with(['manyChild' => function ($q) use ($roleId) {
                $q->whereHas('refRoleMenu', function ($rm) use ($roleId) {
                    $rm->where('role_id', $roleId)->where('read', 1);
                })
                ->orderBy('urutan');
            }])
            ->whereNull('parent_id')
            ->whereHas('refRoleMenu', function ($rm) use ($roleId) {
                $rm->where('role_id', $roleId)->where('read', 1);
            })
            ->orderBy('urutan')
            ->get();

        $view->with('menus', $menus);
        });
    }
}
