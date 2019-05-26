<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Permissoes\Permission;
use App\Models\Permissoes\Role;
use App\Models\Organizacao;
use App\Models\Cargo;
use App\Models\Reunioes;

use App\Notifications\meetingNotify;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    

    
    //relacionamento entre users e reunioes
    public function reunioes(){
        return $this->belongsToMany(Reunioes::class, 'users_reuniao', 'user_id', 'reuniao_id');
    }




    //relacionamento entre users e organizacao
    public function organizacao(){
        return $this->belongsTo(Organizacao::class, 'organizacao_id');
    }

    //relacionamento entre users e cargo
    public function cargo(){
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
    

    public function rolesUser(){

        $rolesUser = DB::table('role_user')->where('user_id', auth()->user()->id)->get();
        
        $permissions = array();
        foreach ($rolesUser as $value) {
            
            $roles = Role::with('permissoes')->where('id', $value->role_id)->get();
            foreach ($roles as $role) {
                array_push($permissions, $role);
            }
   
        }

        return $permissions;
       
    }


    public function roles(){

        return $this->belongsToMany(Role::class);

    }

    public function hasPermission(Permission $permission){

         return $this->hasAnyRoles($permission->roles);


    }


    public function hasAnyRoles($roles){

       
        if ( is_array($roles) || is_object($roles)  ){
            foreach ($roles as $role) {

                return $this->hasAnyRoles($role->nome);
            }
        }



        return $this->roles->contains('nome', $roles);
        
    }

    /*
    protected function isAdmin(){
        
        if( auth()->user()->cargo_id == 2 ){
            return true;
        }else{
            return false;
        }

    }

    */

    protected function isAdminMeeting(){
        
        if( auth()->user()->cargo_id == 2 && auth()->user()->organizacao_id == 2 ){
            return true;
        }else{
            return false;
        }
        
    }
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'cargo_id', 'organizacao_id', 'telefone', 'cpf', 'sexo', 'imagem',  'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];





    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'cpf' => ['required', 'string', 'max:11', 'unique:users'],
            'telefone' => ['required', 'string',  'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
