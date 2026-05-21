<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Laboratoire extends Model
{
    protected $fillable = ['nom','image','description','responsable','axes_recherche','logo','site_web'];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&q=80';
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }
}
