<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $fillable = [
        'nom','image','description','accord','date_accord',
        'contact_nom','contact_email','domaines_cooperation',
        'logo','site_web','type','portee','pays'
    ];
    protected $casts = ['date_accord' => 'date'];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800&q=80';
        if (str_starts_with($this->image, 'http')) return $this->image;
        if (str_starts_with($this->image, 'images/')) return asset($this->image);
        return asset('storage/' . $this->image);
    }
}

