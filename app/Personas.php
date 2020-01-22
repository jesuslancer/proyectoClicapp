<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
     protected $fillable = [
        'nombres', 'apellido_paterno', 'apellido_materno','direccion','email','telefono_contacto_1','telefono_contacto_2','fecha_nac','genero','user_id'
    ];

    /**
     * Persona belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function establecimientos()
    {
        return $this->belongsToMany('App\Establecimientos');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso','curso_persona_asignatura','persona_id','curso_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
