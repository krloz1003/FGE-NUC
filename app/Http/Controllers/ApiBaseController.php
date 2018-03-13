<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Nuc;

class ApiBaseController extends Controller
{
	function calcLuhn($value) {
		$a=2;
		$sum = [];
		/*******************************************
		 Tomamos la longitud o números de caracteres del número ingresado y lo asignamos a $i-1
		 (El algortimo de Lahn empieza de derecha a izquierda) $i-1 es por que el arreglo empieza
		 desde la posición cero.
		 $d toma el dígito de la posición de $i
		 $a<1 => Si a es menor 1 (0, -1) le asigamos 2. que es para multiplicar por los números
		 de la posición par, si no se quedaría con el valor de 1 que es para los impares.
		 $sum[] = $d*$a; => Depues multiplicamos $a por $d y la asiganamos al arreglo de sum.
		 Por ultimo disminuimos el valor de $a por menos 1, para tomar la siguiente posición.
		********************************************/
		for($i=strlen($value)-1;$i>=0;$i--) {
			$d =$value[$i];

			//si es el primero es *2, de lo contrario *1;
			if($a<1) $a=2;
			$sum[] = $d*$a;			
			$a--;
		}
		/*****************************************************************************************
			Vamos a recorres los valores asignados a $sum todos aquellos que sean igual a 1
			caracter lo sumanos al valor de $total y todos aquellos que son mayores
			a 1 caracter se separan y se suman entre si y el resultado se suma con el valor de
			$total.
		*****************************************************************************************/
		$total = 0;
		foreach($sum AS $d) {
			if(strlen($d)==1) $total += $d;
			else {
				$da = str_split($d);
				foreach($da AS $one) { $total += $one; }
			}
		}

		/*****************************************************************************************
			Para terminar sacamos el mod 10 al valor de $total y al resultado de este
			le restamos 10, 10-$total
		*****************************************************************************************/
		$total %= 10;
		if($total != 0) $total = 10-$total;
		return $total;
	}

	function isValidLuhn($value) {
		settype($value, 'string');
		$sumTable = array(
			array(0,1,2,3,4,5,6,7,8,9),
			array(0,2,4,6,8,1,3,5,7,9));
		$sum = 0;
		$flip = 0;

		for ($i = strlen($value) - 1; $i >= 0; $i--) {
			$sum += $sumTable[$flip++ & 0x1][$value[$i]];
		}

		return $sum % 10 === 0;
	}

	public function getRandomCode(){
		$an = "0123456789";
		$su = strlen($an) - 1;
		return substr($an, rand(0, $su), 1) .
				substr($an, rand(0, $su), 1);
	}    

	public function calculateNuc()
	{
		$consecutive = Nuc::select(\DB::raw('substr(nuc, 3, 6) as nuc'))->orderby('nuc','DESC')->take(1)->pluck('nuc');
		$consecutive = str_pad((int)substr($consecutive,4,6)+1, 6, "0", STR_PAD_LEFT);		
		$newNuc = Carbon::now()->formatLocalized('%y').$consecutive.$this->getRandomCode();
		$validator = $this->calcLuhn($newNuc);
		return $newNuc.$validator;
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
