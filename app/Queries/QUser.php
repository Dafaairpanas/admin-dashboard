<?php

namespace App\Queries;

use App\Models\User as Model;
use App\Helper as AppHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QUser
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
                    'role_name' => $item->refRole->name,
                    'role_badge' => $item->refRole->badge_color,
                    'email' => $item->email,
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

            $keys = Model::where('email', $params['email'])->first();
            if ($keys) {
                throw new \Exception("Email sudah terdaftar.");
            }
            $insert = new Model;
            $insert->name = $params['name'];
            $insert->email = $params['email'];
            $insert->password = Hash::make(AppHelper::PASS_DEFAULT);
            $insert->created_at = Carbon::now();
            $insert->updated_at = null;
            $insert->save();

            $insert->refUserRole()->create([
                'role_id' => $params['role_id'],
                'created_at' => Carbon::now(),
                'updated_at' => null,
            ]);
            DB::commit();
            return [
                'items' => $insert,
                'attributes' => null
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
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
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $keys = Model::where('email', $params['email'])->where('id', '!=', $id)->first();
            if ($keys) {
                throw new \Exception("Email sudah terdaftar.");
            }
            $update = Model::find($id);
            $update->name = $params['name'];
            $update->email = $params['email'];
            $update->updated_at = Carbon::now();
            $update->save();

            if (!empty($params['role_id'])) {
                $update->refUserRole()->updateOrCreate([
                    'role_id' => $params['role_id'],
                ], [
                    'created_at' => Carbon::now(),
                    'updated_at' => null,
                ]);
            }

            DB::commit();
            return [
                'items' => $update,
                'attributes' => null
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
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
