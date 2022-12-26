<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCart extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_shop';
    public $timestamps = false;

    protected $table = 'shop_cart';

    protected $fillable = [
        "account"     ,
        "Name"        ,
        "ProductID"   ,
        "description" ,
        "quantity"    ,
        "price"       ,
        "image"       ,
        "time"
    ];
}
