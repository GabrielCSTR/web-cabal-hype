<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabalGuild extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_server01';
    public $timestamps = false;

    protected $table = 'Guild';
}
