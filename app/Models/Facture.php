<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Contenir;

class Facture extends Model
{
    use HasFactory;

    // Relation avec Contenir (une facture a plusieurs éléments)
    public function contenirs()
    {
        return $this->hasMany(Contenir::class, 'idFact');
    }

    // Relation avec Client (une facture appartient à un client)
    public function client()
    {
        return $this->belongsTo(Client::class, 'idClient');
    }

    // Attributs remplissables
    protected $fillable = [
        'DateFact', 'idClient',
    ];
}
