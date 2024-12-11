<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenir extends Model
{
    use HasFactory;

    protected $primaryKey = ['idFact', 'idProd'];

    // Tell Eloquent that the key is not auto-incrementing
    public $incrementing = false;

    // Define the type of key, assuming both 'idFact' and 'idProd' are integers
    protected $keyType = 'int'; // or 'string' depending on your setup

    // Optionally, you can define which fields are fillable (you might want to adjust this)
    protected $fillable = ['Qte', 'idFact', 'idProd'];


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
