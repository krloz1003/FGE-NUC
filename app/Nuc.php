<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nuc extends Model
{
	protected $table = 'nucs';

    protected $fillable = ['nuc', 'estatus'];

    protected $primaryKey = 'id_nuc'; 

    public function setNucAttribute($value)
    {
        $this->attributes['nuc'] = mb_strtoupper($value,'utf-8');
    }
    
    public function folio()
    {
    	return $this->belongsTo('App\Folio');
    }
}
