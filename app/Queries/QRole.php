<?php

namespace App\Queries;

use App\Models\Role as Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QRole
{
    public static function getAllData($params)
    {
        $data = Model::where(function ($query) use ($params) {
            if ($params->search_value) {
                $query->where('name', 'like', '%' . $params->search_value . '%');
            }
        })
            ->whereNull('deleted_at')
            ->orderBy('name', 'asc')
            ->paginate($params->show_data ?? 15);
        return [
            'items' => $data->getCollection()
                ->transform(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'badge_color' => $item->badge_color,
                        'created_at' => Carbon::parse($item->created_at)->format('d-m-Y H:i:s'),
                        'permissions' => $item->refRoleMenu->mapWithKeys(function ($item) {
                            return [
                                $item->menu_id => [
                                    'create' => $item->create,
                                    'read' => $item->read,
                                    'update' => $item->update,
                                    'delete' => $item->delete
                                ],
                            ];
                        })
                    ];
                }),
            'attributes' => [
                'total' => $data->total(),
                'page' => $data->currentPage(),
                'from' => $data->firstItem(),
                'perPage' => $data->perPage(),
                'lastPage' => $data->lastPage(),
            ]
        ];
    }

    public static function getAll($params)
    {
        $data = Model::whereNull('deleted_at')->get();
        return [
            'items' => $data->collect()
                ->transform(function ($items) {
                    return [
                        'id' => $items->id,
                        'name' => $items->name,
                        'badge_color' => $items->badge_color,
                        'created_at' => Carbon::parse($items->created_at)->format('d-m-Y H:i:s'),
                    ];
                })
        ];
    }
    public static function saveData($params)
    {
        DB::beginTransaction();
        try {
            Validator::extend('valid_name', function ($attr, $value) {
                return preg_match("/^[a-zA-Z0-9 ]+$/", $value);
            });

            $validator = Validator::make((array) $params, [
                'name' => 'required|valid_name',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $keys = Model::where('name', $params['name'])->first();
            if ($keys) {
                throw new \Exception("Role sudah terdaftar.");
            }

            $insert = new Model;
            $insert->name = $params['name'];
            $insert->badge_color = $params['badge_color'] ?? null;
            $insert->created_at = Carbon::now();
            $insert->updated_at = null;
            $insert->save();

            // Simpan permission ke role_menu
            if (!empty($params['permissions'])) {
                foreach ($params['permissions'] as $menuId => $value) {
                    $insert->refRoleMenu()->create([
                        'role_id' => $insert->id,
                        'menu_id' => $menuId,
                        'create' => isset($value['create']) ? 1 : 0,
                        'read' => isset($value['read']) ? 1 : 0,
                        'update' => isset($value['update']) ? 1 : 0,
                        'delete' => isset($value['delete']) ? 1 : 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                    ]);
                }
            }

            DB::commit();
            return [
                'items' => $insert,
                'attributes' => null
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public static function updateData($params, $id)
    {
        DB::beginTransaction();
        try {
            Validator::extend('valid_name', function ($attr, $value) {
                return preg_match("/^[a-zA-Z0-9 ]+$/", $value);
            });

            $validator = Validator::make((array) $params, [
                'name' => 'required|valid_name',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $keys = Model::where('name', $params['name'])->where('id', '!=', $id)->first();
            if ($keys) {
                throw new \Exception("Role sudah terdaftar.");
            }
            $update = Model::findOrFail($id);
            $update->name = $params['name'];
            $update->badge_color = $params['badge_color'] ?? null;
            $update->updated_at = Carbon::now();
            $update->save();
            // Update permission ke role_menu
            $update->refRoleMenu()->delete();

            if (!empty($params['permissions'])) {
                foreach ($params['permissions'] as $menuId => $value) {
                    $update->refRoleMenu()->create([
                        'role_id' => $update->id,
                        'menu_id' => $menuId,
                        'create' => !empty($value['create']) ? 1 : 0,
                        'read' => !empty($value['read']) ? 1 : 0,
                        'update' => !empty($value['update']) ? 1 : 0,
                        'delete' => !empty($value['delete']) ? 1 : 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            DB::commit();
            return [
                'items' => $update,
                'attributes' => null
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public static function deleteData($id)
    {
        DB::beginTransaction();
        try {
            $role = Model::findOrFail($id);
            $role->refRoleMenu()->delete();
            $role->delete();
            DB::commit();

            return [
                'items' => $role,
                'attributes' => null
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}
