<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenir extends Model
{
    use HasFactory;

    protected $table = 'contenirs'; // Le nom correct de la table
    protected $fillable = [
        'idFact', 'idProd', 'Qte'
    ];

    // Remove composite primary key definition
    // public $primaryKey = ['idFact', 'idProd']; // This line is unnecessary

    // Disable incrementing for non-auto-increment fields
    public $incrementing = false;  // Leave this as it is

    // Relationships
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProd');
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class, 'idFact');
    }
}
