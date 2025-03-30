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
        // Vérification que l'utilisateur a la permission 'read' sur son token
        if (!auth()->user()->tokenCan('read')) {
            abort(401, 'Non autorisé');
        }

        // Récupère l'utilisateur connecté
        $user = auth()->user();

        // Vérifie le rôle de l'utilisateur
        if ($user->role == 'manager') {
            // Si l'utilisateur est un manager, récupère tous les rendez-vous
            $rdv = Rdv::with(['commercial.user', 'client.prospect'])->get();
        } else {
            // Si l'utilisateur n'est pas un manager, récupère les rendez-vous associés à lui via la table 'commercial'
            $rdv = Rdv::with(['commercial.user', 'client.prospect'])
                    ->whereHas('commercial', function ($query) use ($user) {
                        $query->where('idUser', $user->id);
                    })
                    ->get();
        }

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

        // Retourner la réponse API avec un message de succès et les données des rendez-vous
        return response()->json([
            'succes' => true,
            'message' => 'Liste des rendez-vous',
            'data' => $rdvData,
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
        
        $user = auth()->user();
        
        // Vérifie si l'utilisateur a bien un commercial associé
        if (!$user->commercial) {
            return response()->json([
                "success" => false,
                "message" => "Aucun commercial trouvé pour cet utilisateur."
            ], 404);
        }
        
        $NoCom = $user->commercial->id;
        
        // Validation des données entrantes
        $request->validate([
            'DateRdv' => 'required|date',
            'NoClient' => 'required|integer|exists:clients,id',
        ]);
        
        // Création du rendez-vous 
        $rdv = Rdv::create([
            'DateRdv' => $request->DateRdv,
            'NoCom' => $NoCom,  
            'NoClient' => $request->NoClient
        ]);
        
        // Retourner une réponse JSON avec le code HTTP 201 (création réussie)
        return response()->json([
            "success" => true,
            "message" => "Rendez-vous ajouté avec succès.",
            "data" => $rdv
        ], 201);
        
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
        $rdv = Rdv::find($id);
        $request->validate([
            'DateRdv' => 'required|date',
            'NoClient' => 'required|integer|exists:clients,id',
        ]);
        $user = auth()->user();
        $NoCom = $user->commercial->id;
        // Vérifier si le client existe
        if (is_null($rdv)) {
            return response()->json([
                "success" => false,
                "message" => "rdv non trouvé."
            ], 404);
        }

        // Mettre à jour les données
        $rdv->DateRdv = $request->DateRdv;
        $rdv->NoCom = $NoCom;
        $rdv->NoClient = $request->NoClient; // Gérer les champs optionnels
        $rdv->save();

        // Retourner la réponse
        return response()->json([
            "success" => true,
            "message" => "rdv mis à jour avec succès.",
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
