<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_shop';
    public $timestamps = false;

    protected $table = 'Plans';

    protected $fillable = [
        'Name',
        'Price',
        'Cash',
        'Status'
    ];
}
