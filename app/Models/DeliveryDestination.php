<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryDestination extends Model
{
    use HasFactory;

    protected $table = 'delivery_destination';
    protected $fillable = [
        'delivery_id',
        'delivery_name_1',
        'delivery_name_2',
        'delivery_furigana_1',
        'delivery_furigana_2',
        'note',
        'category_delivery_id_1',
        'category_delivery_id_2',
        'category_delivery_id_3',
        'zipcode',
        'province_id',
        'city',
        'town',
        'address_home',
        'address_1',
        'address_2',
        'phone',
        'fax_number',
        'author_name',
        'time_created',
        'people_update',
        'time_updated',
    ];

    public static function insertDelivery($request)
    {
        $address_1 = $request->input('address_1') ?? '';
        $address_2 = $request->input('address_2') ?? '';
        $data = [
            (string)$request->input('delivery_id'),
            (string)$request->input('delivery_name_1'),
            (string)$request->input('delivery_name_2'),
            (string)$request->input('furigana_1'),
            (string)$request->input('furigana_2'),
            (string)$request->input('zipcode'),
            (string)$request->input('province'),
            (string)$request->input('city'),
            (string)$request->input('town'),
            (string)$request->input('address_home'),
            (string)$address_1,
            (string)$address_2,
            (string)$request->input('phone'),
            (string)$request->input('fax_number'),
            (string)$request->input('category_delivery_1') ?? '',
            (string)$request->input('category_delivery_2') ?? '',
            (string)$request->input('category_delivery_3') ?? '',
            (string)$request->input('note'),
            '897_HieuNM',
            (string)date('Y-m-d H:i:s'),
            '897_HieuNM',
            (string)date('Y-m-d H:i:s')
        ];
        $results = DB::select('EXEC insertDelivery ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ', $data);
        return $results;
    }

    public static function updateDelivery($request, $id)
    {
        $address_1 = $request->input('address_1') ?? '';
        $address_2 = $request->input('address_2') ?? '';
        $data = [
            $id,
            $request->input('delivery_name_1'),
            $request->input('delivery_name_2'),
            $request->input('furigana_1'),
            $request->input('furigana_2'),
            $request->input('zipcode'),
            $request->input('province'),
            $request->input('city'),
            $request->input('town'),
            $request->input('address_home'),
            $address_1,
            $address_2,
            $request->input('phone'),
            $request->input('fax_number'),
            $request->input('category_delivery_1') ?? '',
            $request->input('category_delivery_2') ?? '',
            $request->input('category_delivery_3') ?? '',
            $request->input('note'),
            '897_HieuNM',
            date('Y-m-d H:i:s')
        ];
        $results = DB::select('EXEC updateDelivery ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', $data);
        return $results;
    }

    public static function deleteDeliveryById($id)
    {
        $results = DB::select('EXEC deleteDeliveryById ?', [$id]);
        return $results;
    }

    public static function getDataDeliveryById($id)
    {
        $results = DB::select('EXEC getDeliveryInforById ?', [$id]);
        return $results;
    }

    public static function searchDelivery($request)
    {
        $data = [
            (string)$request->input('delivery_id'),
            (string)$request->input('delivery_name'),
            (string)$request->input('furigana'),
            (string)$request->input('address'),
            (string)$request->input('phone'),
            (string)$request->input('delivery_category_1'),
            (string)$request->input('delivery_category_2'),
            (string)$request->input('delivery_category_3')
        ];
        $results = DB::select('EXEC searchDelivery ?, ?, ?, ?, ?, ?, ?, ?', $data);
        return $results;
    }

    public static function searchInDeliveryDetail($request)
    {
        $data = [
            (string)$request->input('delivery_id'),
            (string)$request->input('delivery_name'),
            (string)$request->input('furigana'),
            (string)$request->input('delivery_category_1'),
            (string)$request->input('delivery_category_2'),
            (string)$request->input('delivery_category_3'),
        ];
        $results = DB::select('EXEC searchInPageDeliveryDetail ?, ?, ?, ?, ?, ?', $data);
        return $results;
    }
}
