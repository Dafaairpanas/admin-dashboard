<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\QRole;
use App\Queries\QMenu;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $params = (object) [
            'search_value' => $request->search_value ?? null,
            'show_data' => $request->show_data ?? 15,
        ];

        $data = QRole::getAllData($params);
        $menus = QMenu::getAll($params);

        return view('pages.role.index', [
            'roles' => $data['items'],
            'menus' => $menus['items'],
            'attributes' => $data['attributes'],
        ]);
    }

    public function store(Request $request)
    {
        try {
            $params = $request->all();
            $save = QRole::saveData($params);

            return redirect()->route('manage.roles.index')->with('success', 'Role created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name,' . $id,
            'badge_color' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role->update([
            'name' => $request->name,
            'badge_color' => $request->badge_color ?? $role->badge_color,
        ]);

        return redirect()->route('manage.roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('manage.roles.index')->with('success', 'Role deleted successfully');
    }
}
