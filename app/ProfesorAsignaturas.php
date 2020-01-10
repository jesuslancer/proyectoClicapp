<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ProfesorAsignaturas extends Model
{
    //use SoftDeletes;
    protected $fillable = ['profesor_id, asignatura_id, establecimineto_id, nivel_id, curso_id, periodo_id'];
}