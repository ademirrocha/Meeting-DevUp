<?php

namespace App\Models\Permissoes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permissoes\Permission;



class Role extends Model
{

	protected $table = 'roles';
    protected $fillable = ['id', 'nome', 'label'];

    public function permissoes(){
    	return $this->belongsToMany(Permission::class);
    }

}
