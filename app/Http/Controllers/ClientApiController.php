<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Prospect;
use Illuminate\Support\Facades\Hash;

class ClientApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (!auth()->user()->tokenCan('read')) {
        abort(401, 'Non autorisé');
    }

    // Charger tous les clients avec la relation 'prospect'
    $clients = Client::with(['prospect'])->get();  // Ici, 'prospect' est la relation définie dans le modèle Client

    // Mapper les données pour inclure les informations du prospect
    $clientsData = $clients->map(function ($clients) {
        return [
            'id' => $clients->id,
            'CPClient' => $clients->CPClient,
            'VilleClient' => $clients->VilleClient,
            'AdresseClient' => $clients->AdresseClient,
            'idProspects' => $clients->idProspects,
            'name' => [
                'nom' => $clients->prospect ? $clients->prospect->NomProspects : 'Nom indisponible',  // Vérifier si le prospect existe
                'prenom' => $clients->prospect ? $clients->prospect->PrenomProspects : 'Prénom indisponible',  // Vérifier si le prospect existe
            ]
        ];
    });

    return response()->json([
        "succes" => true,
        "message" => "Liste des clients",
        "data" => $clientsData,
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->tokenCan('create')) {
            abort(401, 'Non autorisé');
        }
        $idProspect = $request->idProspects ;
        if(!is_null($idProspect)){
            $request->validate([
                'CPClient' => 'required',
                'VilleClient' => 'required',
                'AdresseClient' => 'required',
                'idProspects' => 'required', // Ensure this is validated
            ]);
    
            // Check if the associated prospect exists
            $existingProspect = Prospect::find($request->idProspects);
            if (is_null($existingProspect)) {
                return response()->json([
                    "success" => false,
                    "message" => "Le prospect associé n'existe pas."
                ], 404);
            }
    
            // Create the client, including idProspects
            $clients = Client::create($request->only(['CPClient', 'VilleClient', 'AdresseClient', 'idProspects']));
    
            
        }
        else{
            $request->validate([
                'CPClient' => 'required',
                'VilleClient' => 'required',
                'AdresseClient' => 'required',
                'NomProspects' => 'required',
                'PrenomProspects' => 'required',
                'TelProspects' => 'required',
                'EmailProspects' => 'required|email', // Validation de l'email
                'mdpProspect' => 'required'
            ]);
            
            // Hashing du mot de passe
            $psw = Hash::make($request->mdpProspect);
            
            // Création du prospect avec les bonnes colonnes
            $prospect = Prospect::create([
                'NomProspects' => $request->NomProspects,
                'PrenomProspects' => $request->PrenomProspects,
                'TelProspects' => $request->TelProspects,
                'EmailProspects' => $request->EmailProspects,
                'mdpProspect' => $psw, // Mot de passe haché
            ]);
    
            // Création du client avec l'ID du prospect nouvellement créé
            $clients = Client::create([
                'CPClient' => $request->CPClient,
                'VilleClient' => $request->VilleClient,
                'AdresseClient' => $request->AdresseClient,
                'idProspects' => $prospect->id, // L'ID du prospect
            ]);

        }
        return response()->json([
            "success" => true,
            "message" => "Client ajouté avec succès.",
            "data" => $clients
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->tokenCan('read')){
            abort(401,'non autorisé');
        }

        $clients = Client::with(['prospect'])->find($id);

        if(is_null($clients)){
            return response()->json([
                "success" => false,
                "message" => "Le client n'existe pas."
            ], 404);
        }

            return [
                'id' => $clients->id,
                'CPClient' => $clients->CPClient,
                'VilleClient' => $clients->VilleClient,
                'AdresseClient' => $clients->AdresseClient,
                'idProspects' => $clients->idProspects,
                'name' => [
                    'nom' => $clients->prospect ? $clients->prospect->NomProspects : 'Nom indisponible',  // Vérifier si le prospect existe
                    'prenom' => $clients->prospect ? $clients->prospect->PrenomProspects : 'Prénom indisponible',  // Vérifier si le prospect existe
                ]
            ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trouver le client par ID
        $client = Client::find($id);

        // Vérifier si le client existe
        if (is_null($client)) {
            return response()->json([
                "success" => false,
                "message" => "client non trouvé."
            ], 404);
        }

        // Mettre à jour les données
        $client->CPClient = $request->CP ?? $client->CPClient;;
        $client->VilleClient = $request->ville ?? $client->VilleClient;;
        $client->AdresseClient = $request->adr ?? $client->AdresseClient; // Gérer les champs optionnels
        $client->idProspects = $request->idPro ?? $client->idProspects;   // Gérer les champs optionnels
        $client->save();

        // Retourner la réponse
        return response()->json([
            "success" => true,
            "message" => "client mis à jour avec succès.",
            "data" => $client
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        
        if(!auth()->user()->tokenCan('delete')){
            abort(401,'non autorisé');
        }



        Client::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "client supprimé avec succès.",
        ]);
    }
}
