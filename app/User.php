<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Organizacao;
use App\Models\Cargo;

class User extends Authenticatable
{
    use Notifiable;

    

    

    


    protected function registeredOk(){
        if(auth()->user()->organizacao_confirmed == 1 ){
            return true;
        }else{
            return false;
        }
    }

    protected function isAdmin(){
        
        if( auth()->user()->cargo_id == 2 ){
            return true;
        }else{
            return false;
        }

    }

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
