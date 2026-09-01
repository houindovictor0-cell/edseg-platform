<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoEcole extends Model
{
    protected $table = 'photos_ecole';

    protected $fillable = ['image', 'legende', 'ordre'];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/'.$this->image);
    }
}
