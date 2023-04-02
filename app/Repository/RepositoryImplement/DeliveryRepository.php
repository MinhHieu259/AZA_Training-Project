<?php

namespace App\Repository\RepositoryImplement;

use App\Exports\DeliveryDataExport;
use App\Models\DeliveryCategory;
use App\Models\DeliveryDestination;
use App\Models\Province;
use App\Models\Zipcode;
use App\Repository\IDeliveryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryRepository implements IDeliveryRepository
{

    public function validateInsertDelivery($request)
    {
        $validate = Validator::make($request->all(), [
            'delivery_id' => [
                'required',
                'max:6',
                'regex:/^[a-z0-9]+$/'
            ],
            'delivery_name_1' => [
                'required',
                'max:50'
            ],
            'delivery_name_2' => [
                'max:40'
            ],
            'furigana_1' => [
                'required',
                'max:80',
//                'regex:/^[ぁ-んァ-ン]+$/'
            ],
            'furigana_2' => [
                'max:60',
//                'regex:/^[ぁ-んァ-ン]+$/'
            ],
            'zipcode' => [
                'required',
                'max:8'
            ],
            'province' => [
                'required'
            ],
            'city' => [
                'required',
                'max:12'
            ],
            'town' => [
                'required',
                'max:16'
            ],
            'address_home' => [
                'max:16'
            ],
            'phone' => [
                'required',
                'max:20',
                'regex:/(\d{3})\-?(\d{4})\-?(\d{4})/'
            ],
            'fax_number' => [
                'nullable',
                'max:20',
                'regex:/(\d{3})\-?(\d{4})\-?(\d{4})/'
            ],
            'note' => [
                'max:50'
            ]
        ], [
            'delivery_id.required' => ' フィールドは必須です',
            'delivery_id.max' => 'は4文字までです',
            'delivery_id.regex' => 'の形式が無効です',
            'delivery_name_1.required' => ' フィールドは必須です',
            'delivery_name_1.max' => '最大 50 文字まで含めることができます',
            'delivery_name_2.max' => '最大 40 文字まで含めることができます',
            'furigana_1.required' => 'フィールドは必須です。',
            'furigana_1.max' => '最大 80 文字まで含めることができます',
//            'furigana_1.regex' => 'の形式が無効です',
            'furigana_2.max' => '最大 60 文字まで含めることができます',
//            'furigana_2.regex' => 'の形式が無効です',
            'zipcode.required' => 'を空にすることはできません',
            'zipcode.max' => '最大 8 文字まで含めることができます',
            'province.required' => 'を空白にすることはできません',
            'city.required' => 'は必須フィールドです',
            'city.max' => '最大12文字まで含めることができます',
            'town.required' => 'は必須フィールドです',
            'town.max' => '最大16文字まで含めることができます',
            'address_home.max' => '最大16文字まで含めることができます',
            'phone.required' => 'を空欄にすることはできません',
            'phone.max' => '最大20文字まで含めることができま',
            'phone.regex' => '不正な形式',
            'fax_number.max' => '最大20文字まで含めることができま',
            'fax_number.regex' => '不正な形式',
            'note.max' => '最大50文字まで含めることができま',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validate->getMessageBag()
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Hien thi popup'
            ]);
        }
    }

    public function insertDelivery($request)
    {
        $results = DeliveryDestination::insertDelivery($request);
        if ($results[0]->result == 1) {
            return response()->json([
                'status' => 200,
                'message' => $results[0]->message,
                'delivery_id' => $results[0]->delivery_id
            ]);
        } else if ($results[0]->result == 0) {
            return response()->json([
                'status' => 400,
                'message' => $results[0]->message
            ]);
        }
    }

    public function updateDelivery($request, $id)
    {
        $results = DeliveryDestination::updateDelivery($request, $id);
        if ($results[0]->result == 1) {
            return response()->json([
                'status' => 200,
                'message' => $results[0]->message,
                'delivery_id' => $results[0]->delivery_id,
                'data' => $results[0]
            ]);
        } else if ($results[0]->result == 0) {
            return response()->json([
                'status' => 400,
                'message' => $results[0]->message
            ]);
        }
    }

    public function getAllDeliveryCategory()
    {
        return DeliveryCategory::getAllDeliveryCategory();
    }

    public function getDataDeliveryById($id)
    {
        $results = DeliveryDestination::getDataDeliveryById($id);
        if ($results[0]->result == 0) {
            return response()->json([
                'status' => 400,
                'message' => $results[0]->message
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'data' => $results[0]
            ]);
        }
    }

    public function deleteDeliveryById($id)
    {
        $results = DeliveryDestination::deleteDeliveryById($id);
        if ($results[0]->result == 0) {
            return response()->json([
                'status' => 400,
                'message' => $results[0]->message
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => $results[0]->message
            ]);
        }
    }

    public function searchDelivery($request)
    {
        $results = DeliveryDestination::searchDelivery($request);
        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }

    public function exportDeliveryExcel($request)
    {
        return Excel::download(new DeliveryDataExport($request), 'delivery.xlsx');
    }

    public function searchInDeliveryDetail($request)
    {
        $results = DeliveryDestination::searchInDeliveryDetail($request);
        return $results;
    }
}
