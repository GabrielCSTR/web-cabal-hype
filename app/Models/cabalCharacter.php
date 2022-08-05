<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabalCharacter extends Model
{
    use HasFactory;

    use HasFactory;

    protected $connection = 'sqlsrv_server01';
    public $timestamps = false;

    protected $table = 'cabal_character_table';
}
