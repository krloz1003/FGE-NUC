<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Nuc;

class ApiBaseController extends Controller
{
    public function validateTable($table)
    {
    	return Schema::hasTable('ctr_cipp');
    }

    public function getRandomCode(){
        $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $su = strlen($an) - 1;
        return substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1);
    }    

    public function calculateNuc()
    {
        $nuc = Nuc::orderby('nuc','DESC')->take(1)->pluck('nuc');
        $numero = (int)substr($nuc,4,6);
        $numero = $numero+1;
        $numero = str_pad($numero, 6, "0", STR_PAD_LEFT);
        return Carbon::now()->formatLocalized('%y').$numero.$this->getRandomCode();        
    }

    public function sendResponse($result, $message)
    {
    	$response = [
    		'success' => true,
    		'data' => $result,
    		'message' => $message
    	];

    	return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }    
}
