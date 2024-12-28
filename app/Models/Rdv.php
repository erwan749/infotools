<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Commercial;

class Rdv extends Model
{
    use HasFactory;
    protected $table = 'rdvs';

    public function rdv(){
        return $this->hasMany('App\Rdv');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'NoClient');
    }
    public function commercial()
    {
        return $this->belongsTo(Commercial::class, 'NoCom');
    }

    protected $fillable =[
        'DateRdv', 'NoCom', 'NoClient',
    ];
}
