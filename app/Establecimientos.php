<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimientos extends Model
{
    protected $table = "establecimientos";

    protected $fillable = ['nombre','rbd','dv','director_id','sostenedor_id','utp_id','comuna_id','url_image'];

    public function personas()
    {
        return $this->belongsToMany('App\Personas');
    }

    public function profesores()
    {
        return $this->belongsToMany('App\Personas')->where('persona_tipo_id','=','4');
    }
}
