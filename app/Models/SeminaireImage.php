<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeminaireImage extends Model
{
    protected $fillable = ['seminaire_id', 'image', 'legende', 'ordre'];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/'.$this->image);
    }

    public function seminaire()
    {
        return $this->belongsTo(Seminaire::class);
    }
}
