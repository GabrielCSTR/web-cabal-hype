<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transations extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_shop';
    public $timestamps = false;

    protected $table = 'strdeveloped_transations';

    public function getAccount()
    {
        return $this->belongsTo(cabalAuth::class, 'id_user', 'UserNum');
    }

    public function getPacote()
    {
        return $this->belongsTo(Plans::class, 'id_pacote', 'id');
    }
}
