<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class These extends Model
{
    protected $fillable = [
        'titre','resume','mot_cles','doctorant_id','directeur_id',
        'statut','date_debut','date_soutenance','fichier','publiee',
        'mention','jury','etablissement_cotutelle'
    ];
    protected $casts = [
        'publiee'         => 'boolean',
        'date_debut'      => 'date',
        'date_soutenance' => 'date',
    ];

    public function doctorant() { return $this->belongsTo(Doctorant::class); }
    public function directeur() { return $this->belongsTo(Enseignant::class, 'directeur_id'); }
    public function rapports()  { return $this->hasMany(RapportAvancement::class); }
    public function soutenance(){ return $this->hasOne(Soutenance::class); }
}

