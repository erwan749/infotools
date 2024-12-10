<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;
use App\Models\Facture;

class Client extends Model
{
    use HasFactory;

    public function factures()
    {
        return $this->hasMany(Facture::class, 'idClient'); // Utilisez 'idClient' comme clé étrangère
    }

    public function clients(){
        return $this->hasMany('App\Client');
    }
    public function prospect()
    {
        return $this->belongsTo(Prospect::class , 'idProspects'); 
    }
    protected $fillable =[
        'CPClient', 'VilleClient','AdresseClient','idProspects'
    ];
}
