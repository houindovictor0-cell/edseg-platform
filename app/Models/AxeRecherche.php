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
        if (!$this->image) return 'https://images.unsplash.com/photo-1532619675605-1ede6c2ed2b0?w=800&q=80';
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }
}

