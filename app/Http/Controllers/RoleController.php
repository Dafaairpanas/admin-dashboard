<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search_value;
        $query = Role::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $roles = $query->withCount('users')->orderBy('name')->paginate($request->show_data ?? 15);

        return view('pages.role.index', [
            'data' => $roles,
            'search' => $search
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|max:255',
            'badge_color' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Role::create([
            'name' => $request->name,
            'badge_color' => $request->badge_color ?? '#6c757d',
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
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

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Optional: Check if role is used by users before deleting?
        // For now, strict delete or maybe it cascades or throws error.
        // Assuming cascade or simple delete for now.

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
