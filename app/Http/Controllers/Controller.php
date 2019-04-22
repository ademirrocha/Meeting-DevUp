<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use App\Models\Cargo;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     private $cargo; 

    function __construct(Cargo $cargo)
    {
    	$this->cargo = $cargo;
    }

    public function cadastrarCargo(Request $request){
    	$dados = $request;

    	$cargo = Cargo::where('cargo', $dados->cargo);
 
        if($cargo->count() == 0) {

	        $salv = $this->cargo->create([
	        	'cargo' => $dados->cargo,
	        ]);
    	}
        
        	return redirect()->back();
       
    	
    }



    
    

}
