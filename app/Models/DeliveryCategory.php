<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryCategory extends Model
{
    use HasFactory;

    protected $table = 'category_delivery';
    protected $fillable = [
        'category_delivery_id',
        'cate_delivery_name',
    ];

    public static function getAllDeliveryCategory()
    {
        return DB::select('EXEC getAllDeliveryCategory');
    }

}
