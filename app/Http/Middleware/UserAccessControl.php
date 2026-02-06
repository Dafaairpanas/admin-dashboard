<?php

namespace App\Http\Middleware;

use App\Helper;
use App\Models\Menu;
use App\Models\RoleMenu;
use App\Models\UserRole;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Queries\GlobalVariableQuery as QGV;

class UserAccessControl
{
    public function handle($request, Closure $next)
    {
        if (!QGV::getConfigRole()?->number_value) {
            return $next($request);
        }

        $user = auth()->user();
        $roleUser = $user?->refRoleUser;

        // Jika user tidak punya role, deny access
        if (!$roleUser) {
            return redirect('/permission-denied')->with('error', 'Anda tidak memiliki role yang valid');
        }

        $urls = Route::getCurrentRoute()->getName();

        // Skip checking for permission-denied route
        if ($urls === 'permission.denied') {
            return $next($request);
        }

        $permissionMenu = explode('.', $urls);
        if (isset($permissionMenu[1]) && (in_array($permissionMenu[1], Helper::PERMISSION_ACCESS))) {
            $menuRole = RoleMenu::where('role_id', $roleUser->role_id)
                ->whereHas('refMenu', function ($query) use ($permissionMenu) {
                    $query->where('code', $permissionMenu[0]);
                })
                ->where($permissionMenu[1], 1)
                ->first();

            if ($menuRole) {
                $request->allow_permission = true;
                return $next($request);
            } else {
                if ($permissionMenu[1] == 'read') {
                    // Cari menu pertama yang bisa diakses
                    $firstAccessibleMenu = $this->getFirstAccessibleMenu($roleUser->role_id);

                    if ($firstAccessibleMenu) {
                        return redirect($firstAccessibleMenu->url)
                            ->with('warning', 'Anda tidak memiliki akses ke halaman tersebut');
                    }

                    return redirect('/permission-denied')->with('error', 'Anda tidak memiliki akses untuk halaman ini');
                } else {
                    throw new Exception("Access Forbidden");
                }
            }
        } else {
            $request->allow_permission = true;
            return $next($request);
        }
    }

    /**
     * Cari menu pertama yang bisa diakses oleh role
     */
    private function getFirstAccessibleMenu($roleId)
    {
        $roleMenu = RoleMenu::where('role_id', $roleId)
            ->where('read', 1)
            ->with('refMenu')
            ->first();

        return $roleMenu?->refMenu;
    }
}
