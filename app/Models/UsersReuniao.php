<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;


class UsersReuniao extends Model
{
    protected $table = 'users_reuniao';


    protected $fillable = [
        'user_id', 'reuniao_id', 'confimou_presenca', 'presente',
    ];

   	public function usuario(){
   		return $this->belongsTo(User::class, 'user_id');
   	}
    

}
