<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Client;

class FactureApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(!auth()->user()->tokenCan('read')){
            abort(401,'non autorisé');
        }
        $contenirs = Facture::with('client')->get();

        return response()->json([
            "success" => true,
            "message" => "Liste des facture",
            "data" => $contenirs->map(function ($contenir) {
                return [
                    'id' => $contenir->id, // ID de la facture
                    'DateFact' => $contenir->DateFact, // ID de la facture
                    'idClient' => $contenir->idClient, // id du client
                ];
            }),
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

    $request->validate([
        'DateFact' => 'required|date',
        'idClient' => 'required|int|exists:clients,id',
    ]);

    // Check if the associated prospect exists
    $existingClient = Client::find($request->idClient);
    if (is_null($existingClient)) {
        return response()->json([
            "success" => false,
            "message" => "Le client associé n'existe pas."
        ], 404);
    }

    // Create the facture, including idProspects
    $factures = Facture::create($request->only(['DateFact', 'idClient']));

    return response()->json([
        "success" => true,
        "message" => "Facture ajouté avec succès.",
        "data" => $factures
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

        $Factures = Facture::find($id);

        if(is_null($Factures)){
            return response()->json([
                "success" => false,
                "message" => "facture non trouvé."
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "facture trouver avec succès",
            "data" => $Factures
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trouver le facture par ID
        $factures = Facture::find($id);

        // Vérifier si la facture existe
        if (is_null($factures)) {
            return response()->json([
                "success" => false,
                "message" => "facture non trouvé."
            ], 404);
        }

        // Mettre à jour les données
        $factures->DateFact = $request->DateFact ?? $client->DateFact; // Gérer les champs optionnels
        $factures->idClient = $request->idClient ?? $client->idClient;   // Gérer les champs optionnels
        $factures->save();

        // Retourner la réponse
        return response()->json([
            "success" => true,
            "message" => "facture mis à jour avec succès.",
            "data" => $factures
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



        Facture::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "facture supprimé avec succès.",
        ]);
    }
}
