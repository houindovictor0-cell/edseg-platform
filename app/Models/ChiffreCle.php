<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ChiffreCle extends Model
{
    protected $table = 'chiffres_cles';
    protected $fillable = ['cle', 'valeur', 'label', 'description', 'ordre'];
}
