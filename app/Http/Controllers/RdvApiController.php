<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rdv;
use App\Models\Client;
use App\Models\Prospect;
use App\Models\Commercial;



class RdvApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->tokenCan('read')) {
            abort(401, 'Non autorisé');
        }
    
        // Récupérer tous les rendez-vous et charger les relations 'commercial.user' et 'client.prospect'
        $rdv = Rdv::with(['commercial.user', 'client.prospect'])->get();
    
        // Mapper les données pour inclure les informations du commercial, du client et de l'utilisateur
        $rdvData = $rdv->map(function ($rdv) {
            return [
                'id' => $rdv->id, 
                'date' => $rdv->DateRdv, 
                'commercial' => [
                    'name' => $rdv->commercial && $rdv->commercial->user ? $rdv->commercial->user->name : 'Nom indisponible',
                ],
                'client' => [
                    'nom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->NomProspects : 'Nom indisponible', 
                    'prenom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->PrenomProspects : 'Prénom indisponible', 
                ],
            ];
        });
    
        return response()->json([
            "succes" => true,
            "message" => "Liste des rendez-vous",
            "data" => $rdvData,
        ]);
    }
    


    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Vérifier les permissions d'accès
        if (!auth()->user()->tokenCan('create')) {
            abort(401, 'Non autorisé');
        }
    
        // Validation des données entrantes
        $request->validate([
            'DateRdv' => 'required|date',  // Validation d'un code postal (5 caractères)
            'NoCom' => 'required|integer|exists:commercials,id', // Validation du nom de la ville (chaîne de 2 à 100 caractères)
            'NoClient' => 'required|integer|exists:clients,id', // Validation de l'adresse (chaîne de caractères, max 255 caractères)
        ]);
        
    
        // Création du produit
        $rdvs = Rdv::create($request->only(['DateRdv', 'NoCom', 'NoClient']));
    
        // Retourner une réponse JSON avec le code HTTP 201 (création réussie)
        return response()->json([
            "success" => true,
            "message" => "Produit ajouté avec succès.",
            "data" => $rdvs
        ], 201); // Le code 201 indique que la ressource a été créée
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->tokenCan('read')){
            abort(401,'non autorisé');
        }
        $rdv = Rdv::with(['commercial.user', 'client.prospect'])->find($id);

        if(is_null($rdv)){
            return response()->json([
                "success" => false,
                "message" => "rdv non trouvé."
            ], 404);
        }

        return [
            'id' => $rdv->id, 
            'date' => $rdv->DateRdv, 
            'commercial' => [
                'name' => $rdv->commercial && $rdv->commercial->user ? $rdv->commercial->user->name : 'Nom indisponible',
            ],
            'client' => [
                'nom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->NomProspects : 'Nom indisponible', 
                'prenom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->PrenomProspects : 'Prénom indisponible', 
            ],
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trouver le client par ID
        $rdv = Produit::find($id);

        // Vérifier si le client existe
        if (is_null($rdv)) {
            return response()->json([
                "success" => false,
                "message" => "facture non trouvé."
            ], 404);
        }

        // Mettre à jour les données
        $rdv->DateRdv = $request->DateRdv ?? $produits->DateRdv;;
        $rdv->NoCom = $request->NoCom ?? $produits->NoCom;;
        $rdv->NoClient = $request->NoClient ?? $produits->NoClient; // Gérer les champs optionnels
        $rdv->save();

        // Retourner la réponse
        return response()->json([
            "success" => true,
            "message" => "facture mis à jour avec succès.",
            "data" => $rdv
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



        Rdv::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "rendez-vous supprimé avec succès.",
        ]);
    }
}
