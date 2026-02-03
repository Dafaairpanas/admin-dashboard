<?php

namespace App\Queries;

use App\Models\Languages as Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QLanguages
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
                        'created_at' => Carbon::parse($item->created_at)->format('d-m-Y H:i:s'),
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
                'code' => 'required',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $keys = Model::where('name', $params['name'])->first();
            if ($keys) {
                throw new \Exception("Bahasa sudah terdaftar.");
            }

            $keys = Model::where('code', $params['code'])->first();
            if ($keys) {
                throw new \Exception("Kode Bahasa sudah terdaftar.");
            }

            $insert = new Model;
            $insert->code = $params['code'];
            $insert->name = $params['name'];
            $insert->is_default = $params['is_default'] ?? 0;
            $insert->is_active = $params['is_active'] ?? 1;
            $insert->created_at = Carbon::now();
            $insert->updated_at = null;
            $insert->save();

            DB::commit();
            return [
                'items' => $insert,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function updateData($params)
    {
        DB::beginTransaction();
        try {
            Validator::extend('valid_name', function ($attr, $value) {
                return preg_match("/^[a-zA-Z0-9 ]+$/", $value);
            });

            $validator = Validator::make((array) $params, [
                'name' => 'required|valid_name',
                'code' => 'required',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $keys = Model::where('name', $params['name'])->where('id', '!=', $params['id'])->first();
            if ($keys) {
                throw new \Exception("Bahasa sudah terdaftar.");
            }

            $keys = Model::where('code', $params['code'])->where('id', '!=', $params['id'])->first();
            if ($keys) {
                throw new \Exception("Kode Bahasa sudah terdaftar.");
            }

            $update = Model::find($params['id']);
            $update->code = $params['code'];
            $update->name = $params['name'];
            $update->is_default = $params['is_default'] ?? 0;
            $update->is_active = $params['is_active'] ?? 1;
            $update->updated_at = Carbon::now();
            $update->save();

            DB::commit();
            return [
                'items' => $update,
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
            $delete = Model::destroy($id);
            DB::commit();
            return [
                'items' => $delete,
                'attributes' => null
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
