<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\QUser;
use App\Queries\QRole;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $params = (object) [
            'search_value' => $request->search_value ?? null,
            'show_data' => $request->show_data ?? 15,
        ];

        $data = QUser::getAllData($params);
        $roles = QRole::getAll($params);
        return view('pages.user.index', [
            'data' => $data['items'],
            'attributes' => $data['attributes'],
            'roles' => $roles['items'],
        ]);
    }

    public function store(Request $request)
    {
        try {
            QUser::saveData($request->all());
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            QUser::updateData($request->all(), $id);
            return redirect()->back()->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            QUser::deleteData($id);
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
