<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesor';

    protected $fillable = [
        'persona_id',
    ];

    /**
     * Profesor belongs to Persona.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Persona()
    {
    	// belongsTo(RelatedModel, foreignKey = persona_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Persona::class);
    }
}
