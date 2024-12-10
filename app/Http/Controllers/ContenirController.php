<?php

namespace App\Http\Controllers;

use App\Models\Contenir;
use App\Models\Produit;
use App\Models\Facture;

use Illuminate\Http\Request;

use App\Http\Requests\StoreContenirRequest;
use App\Http\Requests\UpdateContenirRequest;

class ContenirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($facture_id)
    {
        // Vérifiez si la facture existe
        $facture = Facture::find($facture_id);
        if (!$facture) {
            return redirect()->route('factures.index')->with('error', 'Facture non trouvée.');
        }

        // Récupérer les produits disponibles
        $produits = Produit::all();

        // Retourner la vue avec l'ID de la facture
        return view('factures.contenirs.create', compact('facture_id', 'produits'));
    }


    public function store(Request $request)
{
    // Validation des données
// Check if the product already exists in the invoice
$contenir = Contenir::where('idFact', $request->idFact)
                    ->where('idProd', $request->idProd)
                    ->first();

if ($contenir) {
    // Update the quantity instead of creating a new record
    $contenir->Qte += $request->Qte;
    $contenir->save();

    return redirect()->route('factures.show', $request->idFact)
                     ->with('success', 'Quantité mise à jour pour ce produit.');
} else {
    // Create a new record
    Contenir::create([
        'idFact' => $request->idFact,
        'idProd' => $request->idProd,
        'Qte' => $request->Qte,
    ]);

    return redirect()->route('factures.show', $request->idFact)
                     ->with('success', 'Produit ajouté à la facture.');
}}

        
    /**
     * Display the specified resource.
     */
    public function show(Contenir $contenir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contenir $contenir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContenirRequest $request, Contenir $contenir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($facture_id, $produit_id)
    {
        // Find the record using idFact and idProd
        $contenir = Contenir::where('idFact', $facture_id)
                            ->where('idProd', $produit_id)
                            ->first();
    
        // If the record does not exist, redirect with an error
        if (!$contenir) {
            return redirect()->back()->with('error', 'Produit non trouvé dans la facture.');
        }
    
        // Delete the record by using the composite keys explicitly
        Contenir::where('idFact', $facture_id)
                ->where('idProd', $produit_id)
                ->delete();
    
        // Redirect with a success message
        return redirect()->route('factures.show', $facture_id)
                         ->with('success', 'Produit supprimé de la facture.');
    }
    
    
        
}
