<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(!auth()->user()->tokenCan('read')){
            abort(401,'non autorisé');
        }
        $produits = Produit::all();
        return response()->json([
            "succes"=>true,
            "message"=>"Liste des produit",
            "data"=> $produits,
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
            'typeProd' => 'required|string', // Validation de type string
            'prixProd' => 'required|numeric|min:0', // Validation de type numérique avec une valeur minimale de 0
            'nomProd' => 'required|string|max:255', // Validation de type string avec une longueur maximale
            'descProd' => 'required|string|min:10|max:500', // Validation de type string avec une longueur minimale et maximale
        ]);
    
        // Création du produit
        $produit = Produit::create($request->only(['typeProd', 'prixProd', 'nomProd', 'descProd']));
    
        // Retourner une réponse JSON avec le code HTTP 201 (création réussie)
        return response()->json([
            "success" => true,
            "message" => "Produit ajouté avec succès.",
            "data" => $produit
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

        $produits = Produit::find($id);

        if(is_null($produits)){
            return response()->json([
                "success" => false,
                "message" => "produit non trouvé."
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "produit trouver avec succès",
            "data" => $produits
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Trouver le client par ID
        $produits = Produit::find($id);
        $request->validate([
            'typeProd' => 'required|string', // Validation de type string
            'prixProd' => 'required|numeric|min:0', // Validation de type numérique avec une valeur minimale de 0
            'nomProd' => 'required|string|max:255', // Validation de type string avec une longueur maximale
            'descProd' => 'required|string|min:10|max:500', // Validation de type string avec une longueur minimale et maximale
        ]);

        // Vérifier si le client existe
        if (is_null($produits)) {
            return response()->json([
                "success" => false,
                "message" => "facture non trouvé."
            ], 404);
        }

        // Mettre à jour les données
        $produits->typeProd = $request->typeProd ?? $produits->typeProd;;
        $produits->prixProd = $request->prixProd ?? $produits->prixProd;;
        $produits->nomProd = $request->nomProd ?? $produits->nomProd; // Gérer les champs optionnels
        $produits->descProd = $request->descProd ?? $produits->descProd;   // Gérer les champs optionnels
        $produits->save();

        // Retourner la réponse
        return response()->json([
            "success" => true,
            "message" => "facture mis à jour avec succès.",
            "data" => $produits
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



        Produit::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "facture supprimé avec succès.",
        ]);
    }
}
