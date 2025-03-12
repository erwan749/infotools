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

            Contenir::create([
                'idFact' => $request->idFact,
                'idProd' => $request->idProd,
                'Qte' => $request->Qte,
            ]);

            return redirect()->route('factures.show', $request->idFact)
                            ->with('success', 'Produit ajouté à la facture.');
    }

        
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
    public function edit($idFact, $idProd)
    {
        $user = auth()->user();
        if ($user->role != 'manager') {
            return redirect()->route('factures.show', ['facture' => $idFact])
                             ->with('error', 'Vous n\'avez pas les droits pour modifier cette facture');
        }
        // Récupérer le contenu de la facture avec le produit et la quantité
        $contenir = Contenir::where('idFact', $idFact)
                            ->where('idProd', $idProd)
                            ->first();
        $produits = Produit::all();
        // Vérifier si le contenu existe
        if (!$contenir) {
            return redirect()->route('factures.index')->with('error', 'Produit non trouvé dans cette facture');
        }
    
        // Passer le contenu et l'idFact à la vue
        return view('factures.contenirs.edit', compact('contenir', 'idFact','produits'));
    }
    

    

    /**
     * Update the specified resource in storage.
     */
    /**
 * Update the specified resource in storage.
 */
    public function update(Request $request, $idFact, $idProd)
    {
        $request->validate([
            'Qte' => 'required|integer|min:1',
            'idProd' => 'required|exists:produits,id', // Ensure the product exists
        ]);
        $contenir = Contenir::where('idFact', $idFact)
                            ->where('idProd', $idProd)
                            ->first();

         if (!$contenir) {
             return redirect()->back()->with('error', 'Produit non trouvé dans la facture.');
         }
    
         // Delete the record by using the composite keys explicitly
         Contenir::where('idFact', $idFact)
                 ->where('idProd', $idProd)
                 ->delete();                    

        Contenir::create([
            'idFact' => $idFact,
            'idProd' => $request->idProd,
            'Qte' => $request->Qte,
        ]);

        // Redirect with a success message
        return redirect()->route('factures.show', $idFact)
                        ->with('success', 'Produit et quantité mis à jour dans la facture.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($facture_id, $produit_id)
    {
        $user = auth()->user();
    
        if ($user->role != 'manager') {
            return redirect()->route('factures.show', ['facture' => $facture_id])
                             ->with('error', 'Vous n\'avez pas les droits pour modifier cette facture');
        }
        $contenir = Contenir::where('idFact', $facture_id)
                            ->where('idProd', $produit_id)
                            ->first();
    
        if (!$contenir) {
            return redirect()->back()->with('error', 'Produit non trouvé dans la facture.');
        }
    
        Contenir::where('idFact', $facture_id)
                ->where('idProd', $produit_id)
                ->delete();
    
        return redirect()->route('factures.show', $facture_id)
                         ->with('success', 'Produit supprimé de la facture.');
    }
    
    
        
}
