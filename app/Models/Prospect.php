<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;


    public function prospects(){
        return $this->hasMany('App\Prospect');
        
    }
    public function prospect()
{
    return $this->belongsTo(Prospect::class, 'id'); // Remplacez 'idprospect' par le nom de votre clé étrangère
}

    protected $fillable =[
        'NomProspects', 'PrenomProspects','telProspects' ,'EmailProspects', 'mdpProspect'
    ];
}
