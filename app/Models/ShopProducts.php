<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProducts extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_shop';
    public $timestamps = false;

    protected $table = 'Products';
    protected $primaryKey = 'ProductID';

    protected $fillable = [
        'Name',
        'Description',
        'ItemIDX',
        'OptionIDX',
        'Duration',
        'Image',
        'Stock',
        'Price',
        'ProductCategoryID',
        'Destaque',
        'QntVend'
    ];
}
