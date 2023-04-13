<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estat_expedients extends Model
{
    use HasFactory;

    protected $table = 'estat_expedients';

    public function expedients()
    {
        return $this->hasMany(Expedients::class, 'estat_expedients_id');
    }
}