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
            'items' => collect($data->items())
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
        // Ambil semua menu
        $allMenus = Model::withoutGlobalScopes()
            ->orderBy('urutan', 'asc')
            ->get();

        // Pisahkan parent dan child menus
        $parentMenus = $allMenus->whereNull('parent_id')->whereNull('url');
        $childMenus = $allMenus->whereNotNull('parent_id')->whereNotNull('url');

        // Grup child menus berdasarkan parent_id
        $grouped = $childMenus->groupBy('parent_id')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'parent_id' => $item->parent_id,
                    'url' => $item->url,
                    'code' => $item->code,
                    'urutan' => $item->urutan,
                ];
            })->toArray();
        })->toArray();

        // Buat struktur dengan nama parent sebagai key
        $result = [];
        foreach ($parentMenus as $parent) {
            $parentName = $parent->name;
            $result[$parentName] = $grouped[$parent->id] ?? [];
        }

        return [
            'items' => $result
        ];
    }
}
