<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    protected $table = 'folios';

    protected $fillable = ['numero', 'id_modulo', 'id_nuc'];

    protected $primaryKey = 'id_folio'; 

    public function setNumeroAttribute($value)
    {
        $this->attributes['numero'] = mb_strtoupper($value,'utf-8');
    }    
    
    public function nucs()
    {
        return $this->hasMany('App\Nuc');
    }

    public function modulos()
    {
        return $this->hasMany('App\Modulo');
    }
}
