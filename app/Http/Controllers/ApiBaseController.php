<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    public function validateTable($table)
    {
    	return Schema::hasTable('ctr_cipp');
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
