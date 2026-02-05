<?php

namespace App\Queries;

use App\Models\Submission as Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QSubmission
{
    public static function getAllData($params)
    {
        $data = Model::where(function ($query) use ($params) {
            if ($params->search_value) {
                $query->where('full_name', 'like', '%' . $params->search_value . '%')
                    ->orWhere('phone_number', 'like', '%' . $params->search_value . '%')
                    ->orWhere('email', 'like', '%' . $params->search_value . '%');
            }
        })
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate($params->show_data ?? 15);

        return [
            'items' => $data->getCollection()
                ->transform(function ($item) {
                    return [
                        'id' => $item->id,
                        'full_name' => $item->full_name,
                        'email' => $item->email,
                        'phone_number' => $item->phone_number,
                        'visitor_category_name' => $item->refMasterVisitorCategory->name ?? null,
                        'company_name' => $item->company_name,
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
            $validator = Validator::make((array) $params, [
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'visitor_category_id' => 'required|exists:master_visitor_categories,id',
                'company_name' => 'nullable|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'business_type' => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $insert = new Model;
            $insert->survey_id = $params['survey_id'] ?? null;
            $insert->full_name = $params['full_name'];
            $insert->phone_number = $params['phone_number'];
            $insert->email = $params['email'];
            $insert->visitor_category_id = $params['visitor_category_id'];
            $insert->company_name = $params['company_name'] ?? null;
            $insert->job_title = $params['job_title'] ?? null;
            $insert->business_type = $params['business_type'];
            $insert->wa_verified_at = null;
            $insert->created_at = Carbon::now();
            $insert->updated_at = null;
            $insert->save();

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
}
