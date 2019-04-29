<?php

namespace App\Models\Permissoes;

use Illuminate\Database\Eloquent\Model;

use App\Models\Permissoes\Role;



class Permission extends Model
{
    protected $fillable = ['nome', 'label'];

    protected $table = 'permissions';

    public function roles(){
    	return $this->belongsToMany(Role::class);
    }


   

    
}
