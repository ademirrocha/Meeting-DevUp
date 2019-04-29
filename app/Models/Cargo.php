<?php

namespace App\Models;
use App\Models\Cargo;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    
    protected $fillable = ['cargo'];

    
    //relacionamento entre cardo e users
	public function users(){
        return $this->hasMany(User::class, 'cargo_id');
    }

    
}