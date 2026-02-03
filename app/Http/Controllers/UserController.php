<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
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

        $data = QUser::getAllData($params);
        return view('pages.user.index', [
            'data' => $data['items'],
            'attributes' => $data['attributes'],
        ]);
    }
}
