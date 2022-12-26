<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class cabalAuth extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'UserNum';
    protected $connection = 'sqlsrv';

    protected $table = 'cabal_auth_table';

    protected $hidden = ['Password'];
    public $timestamps = false;

    public function getAuthIdentifier()
    {
         return $this->getKey();
    }

    public function isAdmin()
    {
        return Auth::user()->is_admin;
    }

    public function isActive()
    {
        return Auth::user()->is_active;
    }

    public function maskEmail()
    {
        $email = Auth::user()->Email;
        return substr($email, 0, 3).'****'.substr($email, strpos($email, "@"));
    }
}
