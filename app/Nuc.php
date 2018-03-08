<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nuc extends Model
{
	protected $table = 'nucs';

    protected $fillable = ['nuc', 'estatus'];

    protected $primaryKey = 'id_nuc'; 	
    
    public function folio()
    {
    	return $this->belongsTo('App\Folio');
    }
}
