<?php

namespace App\Queries;

use App\Models\Menu as Model;
use Carbon\Carbon;

class QMenu
{
    public static function getAllData($params)
    {
        $data = Model::where(function ($query) use ($params) {
            if ($params->search_value) {
                $query->where('name', 'like', '%' . $params->search_value . '%');
            }
        })
            ->where('url', '!=', 'null')
            ->paginate($params->show_data ?? 15);
        return [
            'items' => $data->collect()
                ->forPage($data->currentPage(), $data->perPage())
                ->transform(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'created_at' => Carbon::parse($item->created_at)->format('d-m-Y H:i:s'),
                    ];
                }),
            'attributes' => [
                'total' => $data->total(),
                'page' => $data->currentPage(),
                'from' => $data->firstItem(),
                'perPage' => $data->perPage(),
                'lastPage' => $data->lastPage()
            ]
        ];
    }

    public static function getAll($params)
    {
        // Menu clickable adalah yang memiliki parent_id (child dari label sidebar)
        // Menu label (header) tidak punya parent_id
        $data = Model::withoutGlobalScopes()
            ->whereNotNull('parent_id')
            ->orderBy('urutan', 'asc')
            ->get();
        // Data sudah benar: hanya menu dengan parent_id yang diambil
        return [
            'items' => $data->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'parent_id' => $item->parent_id,
                    'parent_name' => $item->parent ? $item->parent->name : null,
                    'url' => $item->url,
                    'code' => $item->code,
                    'urutan' => $item->urutan,
                    'created_at' => Carbon::parse($item->created_at)->format('d-m-Y H:i:s'),
                ];
            })
        ];
    }
}
