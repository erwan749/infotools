<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenir;
use App\Models\Facture;
use App\Models\Produit;

class ContenirApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(!auth()->user()->tokenCan('read')){
            abort(401,'non autorisé');
        }
        $contenirs = Contenir::with('produit')->get();

        return response()->json([
            "success" => true,
            "message" => "Liste du contenu des commandes",
            "data" => $contenirs->map(function ($contenir) {
                return [
                    'idProd' => $contenir->idProd, // ID du produit
                    'idFact' => $contenir->idFact, // ID de la facture
                    'nomProd' => $contenir->produit->nomProd, // Nom du produit
                    'qte' => $contenir->Qte
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
        'idProd' => 'required',
        'idFact' => 'required',
        'Qte' => 'required',
    ]);

    $existingFact = Facture::find($request->idFact);
    $existingProduit = Produit::find($request->idProd);

    if (is_null($existingProduit) or is_null($existingFact) ) {
        return response()->json([
            "success" => false,
            "message" => "Le produit ou la facture associé n'existe pas."
        ], 404);
    }

    $contenirs = Contenir::create($request->only(['idProd', 'idFact', 'Qte']));

    return response()->json([
        "success" => true,
        "message" => "Contenue ajouté avec succès.",
        "data" => $contenirs
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

        $contenirs = Contenir::where('idFact', $id) 
        ->with('produit') // Charger les produits associés
        ->get();

    if ($contenirs->isEmpty()) { //verifie si il retoune une valeure 
        return response()->json([
            "success" => false,
            "message" => "Aucun contenu trouvé pour cette facture."
        ], 404);
    }

    return response()->json([
        "success" => true,
        "message" => "Contenu de la facture : ". $id ." trouvé avec succès",
        "data" => $contenirs->map(function ($contenir) {
            return [
                'idProd' => $contenir->idProd,//requpere les valeur demander 
                'nomProd' => $contenir->produit->nomProd,
                'qte' => $contenir->Qte,
                ];
            }),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idProd, $idFact)
    {
    if (!auth()->user()->tokenCan('update')) {
        return response()->json(["success" => false, "message" => "Unauthorized."], 401);
    }

    // Validate incoming request data
    $validatedData = $request->validate([
        'Qte' => 'required|integer|min:0', // Restriction sur la qte
    ]);

    $updated = Contenir::where('idProd', (int)$idProd)
        ->where('idFact', (int)$idFact)
        ->update($validatedData);

    if ($updated === 0) {
        return response()->json(["success" => false, "message" => "Item not found or no changes made."], 404);
    }

    return response()->json(["success" => true, "message" => "Contenir updated successfully."]);
}

    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idProd, $idFact)
    {
        if (!auth()->user()->tokenCan('delete')) {
            return response()->json(["success" => false, "message" => "Unauthorized."], 401);
        }
    
        // Attempt to delete the record directly
        $deleted = Contenir::where('idProd', (int)$idProd)
            ->where('idFact', (int)$idFact) //cheche la ligne
            ->delete();//supprime la ligne
    
        if ($deleted === 0) {
            return response()->json(["success" => false, "message" => "Item not found."], 404);
        }
    
        return response()->json(["success" => true, "message" => "Contenir deleted successfully."]);
    }
                                    
}
