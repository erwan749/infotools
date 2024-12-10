<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Commercial extends Model
{
    use HasFactory;


    public function commerciaux(){
        return $this->hasMany('App\Commerciaux');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    protected $fillable =[
        'cpCom','villeCom','rueCom','telCom','idUser'
    ];
}
