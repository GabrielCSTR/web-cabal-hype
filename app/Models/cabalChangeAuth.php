<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class cabalChangeAuth extends Model
{
    use HasApiTokens;
    public $timestamps = false;

    protected $connection = 'sqlsrv';

    protected $table = 'cabal_charge_auth';

    protected $fillable = [
        'UserNum',
        'ServiceKind',
        'ExpireDate',
    ];
}
