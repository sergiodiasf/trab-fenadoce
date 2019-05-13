<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'candidata_id',
    ];

    public function candidata()
    {
        return $this->belongsTo('App/Candidata');
    }
}
