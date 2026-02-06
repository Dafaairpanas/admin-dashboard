<?php

namespace App;

use App\Models\Menu;
use App\Models\RoleMenu;
use Illuminate\Support\Facades\Auth;

class Helper
{
  const PASS_DEFAULT = "Rajawali2025";
  const PERMISSION_ACCESS = [
    'create',
    'read',
    'update',
    'delete'
  ];
  const TRIGGER_ACTIVE_MENU_CHILD = 'child';

  public static function hasPermission($menuCode, $permission)
  {
    $user = Auth::user();
    if (!$user)
      return false;

    // Ambil role_id user (dari relasi user_role)
    $roleUser = $user->refRoleUser;
    if (!$roleUser)
      return false;

    $roleId = $roleUser->role_id;

    // Cari menu berdasarkan code
    $menu = Menu::where('code', $menuCode)->first();
    if (!$menu)
      return false;

    // Cari role_menu sesuai role dan menu
    $roleMenu = RoleMenu::where('role_id', $roleId)
      ->where('menu_id', $menu->id)
      ->first();

    if (!$roleMenu)
      return false;
    return (bool) $roleMenu->{$permission};
  }
}