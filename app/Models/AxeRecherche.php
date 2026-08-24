<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AxeRecherche extends Model
{
    protected $table = 'axes_recherche';
    protected $fillable = ['titre','image','description','mots_cles','actif','ordre'];
    protected $casts = ['actif' => 'boolean'];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return '/images/reherche.png';
        if (str_starts_with($this->image, 'http')) return $this->image;
        if (str_starts_with($this->image, 'images/')) return asset($this->image);
        return asset('storage/' . $this->image);
    }
}

