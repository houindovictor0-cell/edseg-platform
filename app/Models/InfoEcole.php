<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InfoEcole extends Model
{
    protected $table = 'infos_ecole';
    protected $fillable = ['cle', 'valeur', 'label', 'type'];
}

