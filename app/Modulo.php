<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';

    protected $fillable = ['nombre'];

    protected $primaryKey = 'id_modulo';

    public function folio()
    {
    	return $this->belongsTo('App\Folio');
    } 
}