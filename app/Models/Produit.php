<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    public function produits(){
        return $this->hasMany('App\Produit');
    }
    public function contenirs()
    {
        return $this->hasMany(Contenir::class, 'idProd');
    }
    protected $fillable =[
        'typeProd', 'prixProd', 'nomProd', 'descProd',
    ];
}
