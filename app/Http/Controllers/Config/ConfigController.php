<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permissoes\Role;
use App\Models\Permissoes\Permission;
use Gate;


use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{

    public function permissoes(){

    	//$this->authorize('view-permissoes');

    	if(Gate::denies('edite-permissoes')){
    		abort(403, 'Erro: Não Autorizado');
    	}

    	$roles = Role::with('permissoes')->get();

        $allPermissions = Permission::all();

    	return view('vendor.meeting.config.permissions', compact('roles', 'allPermissions'));
    	
    }

    public function editarPermissoes($id, Request $request){

    	if(Gate::denies('edite-permissoes')){
    		abort(403, 'Não Autorizado');
    	}

        

        $nome = 'view_organizacao';

        $dados = $request->except(['_token']);


        //dd($dados);


    	foreach ($dados as $key => $value) {

            $permissao = DB::select('select * From permissions where nome = ?', [$key]);



            $row = DB::table('permission_role')->where('permission_id', '=', $permissao[0]->id)->where('role_id', '=', $id);

            

            
            if($row->count() > 0){
                if($value == 'nao'){

                    DB::table('permission_role')->where('permission_id', '=', $permissao[0]->id)->where('role_id', '=', $id)->delete();
                }
                

            }else{
                 if($value == 'sim'){
                    DB::table('permission_role')->insert([
                        ['role_id' => $id, 'permission_id' => $permissao[0]->id]
                    ]);
                 }
                
            }
                 
   
        }

        return redirect()->back();




    }
}
