<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';

     protected $fillable = [
        'nombres', 'apellido_paterno', 'apellido_materno','direccion','email','telefono_contacto_1','telefono_contacto_2','fecha_nac','genero','user_id'
    ];

    /**
     * Persona belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class);
    }
}
