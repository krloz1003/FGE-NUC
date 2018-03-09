<?php

namespace App\Http\Controllers;

use App\Http\Controllers\APIBaseController as APIBaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Nuc;
use App\Modulo;
use App\Folio;

class NucController extends APIBaseController
{
    
    public function index()
    {
    	$nucs = Nuc::all();
    	return $this->sendResponse($nucs->toArray(), 'La consulta fue satisfactoria.');   	

    }

    public function store(Request $request)
    {
        $input = $request->all();
        //$numero =$request->input('numero');
        
        $validator = Validator::make($input, [
            'numero' => 'required',
            'id_modulo' => 'required|unique:folios,id_modulo,NULL,id_folio,numero,'.$request->input('numero')
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error. ', $validator->errors());
        }

        // Consultar id del modulo;
        //$id_modulo = Modulo::where('nombre', $request->input('modulo'))->value('id_modulo');
        
        // Generación del NUC y guardar en la tabla    
        $nuc = new Nuc;
		$nuc->nuc = $this->calculateNuc();
		$nuc->save();

        if (is_null($nuc)) {            
            return $this->sendResponse('Al parecer tuvimos un inconveniente al generar el NUC. Intente de nuevo.');       
        }        

        // Relacionar el NUC con el solicitante.
        $folio = new Folio;
        $folio->numero = $request->input('numero');
        $folio->id_modulo = $request->input('id_modulo');
        $folio->id_nuc = $nuc->id_nuc;
        $folio->save();

        if (is_null($nuc)) {            
            return $this->sendResponse('Al parecer tuvimos un inconveniente al generar el NUC. Intente de nuevo.');       
        }         
        
        return $this->sendResponse($nuc->nuc,'EL Nuc se ha generado correctamente.');        
    }
}
