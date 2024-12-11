<?php

namespace App\Http\Controllers;

use App\Models\Rdv;
use App\Models\Client;
use App\Models\Commercial; 
use App\Http\Requests\Request;

class RdvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rdv = Rdv::with(['commercial.user', 'client.prospect'])->get();
        
        // Mapper les données pour inclure les informations du commercial, du client et de l'utilisateur
        $rdvData = $rdv->map(function ($rdv) {
            return [
                'id' => $rdv->id, 
                'DateRdv' => $rdv->DateRdv, 
                'commercial' => [
                    'name' => $rdv->commercial && $rdv->commercial->user ? $rdv->commercial->user->name : 'Nom indisponible',
                ],
                'client' => [
                    'nom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->NomProspects : 'Nom indisponible', 
                    'prenom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->PrenomProspects : 'Prénom indisponible', 
                ],
            ];
        });
        return view('rdv.index', compact('rdvData'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $commercials = Commercial::all();
        return view('rdv.create', compact('clients', 'commercials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rdv $rdv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rdv $rdv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rdv $rdv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rdv $rdv)
    {
        //
    }
}
