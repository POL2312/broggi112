<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedients extends Model
{
    use HasFactory;

    protected $table = 'expedients';
    protected $primaryKey = 'id';
    public $timestamp = false;

    public function estat_expedients()
    {
        return $this->belongsTo(Estat_expedients::class, 'estat_expedients_id');
    }
    
    public function cartes_trucades()
    {
        return $this->hasMany(Expedients::class, 'expedients_id');
    }
}