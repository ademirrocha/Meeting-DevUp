<?php

namespace App\Models;
use App\Models\Cargo;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    
    protected $fillable = ['cargo'];

    public function usuario(){
	    return $this->belongsTo(User::class);
	}

    
}