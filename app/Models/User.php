<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasApiTokens;

    protected $connection = 'sqlsrv';

    // protected $fillable = [
    //     'ID',
    //     'AuthType',
    //     'Email',
	// ];

    protected $table = 'cabal_auth_table';
}
