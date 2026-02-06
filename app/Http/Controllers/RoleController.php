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
        $menusData = QMenu::getAll($params);

        return view('pages.role.index', [
            'roles' => $data['items'],
            'groupedMenus' => $menusData['items'],
            'attributes' => $data['attributes'],
        ]);
    }

    public function store(Request $request)
    {
        try {
            $params = $request->all();
            $save = QRole::saveData($params);

            return redirect()->route('ROLES.read')->with('success', 'Role created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $role = QRole::getById($id);
        $menus = QMenu::getAll((object) []);

        return response()->json([
            'role' => $role,
            'menus' => $menus['items']
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $params = $request->all();
            QRole::updateData($params, $id);

            return redirect()->route('ROLES.read')->with('success', 'Role updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('ROLES.read')->with('success', 'Role deleted successfully');
    }
}
