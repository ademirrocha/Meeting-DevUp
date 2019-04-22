<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UsersReuniao extends Model
{
    protected $table = 'users_reuniao';


    protected $fillable = [
        'user_id', 'reuniao_id', 'tipo', 'presente',
    ];

}
