<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabalLogsPremium extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_shop';
    public $timestamps = false;

    protected $table = 'cabal_logs_premium';

    protected $fillable = [
        'Account',
        'UserNum',
        'IP',
        'Data',
        'Tipo',
    ];
}
