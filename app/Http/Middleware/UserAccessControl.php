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

class UserAccessControl{
    public function handle($request, Closure $next)
    {
        if(!QGV::getConfigRole()->number_value) {
            return $next($request);
        }
        $urls = Route::getCurrentRoute()->getName();
        $permissionMenu = explode('.', $urls);
        if(isset($permissionMenu[1]) && (in_array($permissionMenu[1],Helper::PERMISSION_ACCESS) )) {
            $menuRole = RoleMenu::where('role_id', auth()->user()->refUserRole->role_id)
                        ->whereHas('refMenu', function($query) use($permissionMenu){
                            $query->where('code', $permissionMenu[0]);
                        })
                        ->where($permissionMenu[1], 1)
                        ->first();

            // dd([
            //     'current_route' => $urls,
            //     'permission_split' => $permissionMenu,
            //     'role_id' => auth()->user()->refUserRole->role_id,
            //     'menu_code_lookup' => $permissionMenu[0],
            //     'permission_type' => $permissionMenu[1],
            //     'query_result' => $menuRole,
            // ]);

            if($menuRole) {
                $request->allow_permission = true;
                return $next($request);

            } else {
                if ($permissionMenu[1] == 'read') {
                    return redirect('/permission-denied')->with('error', 'Anda tidak memiliki akses untuk halaman ini');
                } else {
                    throw new Exception("Access Forbidden");
                }
                // return $next($request);
                // return $permissionMenu[1] == 'read' ? redirect('/permission-denied') : throw new Exception("Access Forbidden");
            }
        } else {
            $request->allow_permission = true;
            return $next($request);
        }
    }
}
