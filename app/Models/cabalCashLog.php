<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabalCashLog extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_shop';
    public $timestamps = false;

    protected $table = 'shop_log';

    protected $fillable = [
        'usernum',
        'purchasedate',
        'itemnum',
        'durationidx',
        'quantity',
        'PriceCoin',
        'PricePoint',
        'Para'
    ];
}
