<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabalCash extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_cabalcash';

    protected $table = 'CashAccount';
    public $timestamps = false;
}
