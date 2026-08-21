<?php
// app/Models/Mention.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    protected $fillable = ['nom', 'code', 'description'];

    public function specialites()
    {
        return $this->hasMany(Specialite::class);
    }
}
