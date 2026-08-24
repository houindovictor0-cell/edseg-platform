<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Laboratoire extends Model
{
    protected $fillable = ['nom','image','description','responsable','axes_recherche','logo','site_web'];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return '/images/lab.png';
        if (str_starts_with($this->image, 'http')) return $this->image;
        if (str_starts_with($this->image, 'images/')) return asset($this->image);
        return asset('storage/' . $this->image);
    }

    public function projets()
{
    return $this->hasMany(ProjetRecherche::class);
}
}
