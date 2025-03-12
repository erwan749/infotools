<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les factures avec les informations du client
        $factures = Facture::with('client.prospect')->get(); // Charge 'client' et 'prospect' associé au client

        return view('factures.index', compact('factures'))
            ->with('i', (request()->input('page', 1) - 1) * 50);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::with(['prospect'])->get();
        return view('factures.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customMessages = [
            'DateFact.required' => 'La date de la facture est obligatoire.',
            'DateFact.date' => 'La date de la facture doit être une date valide.',
            'DateFact.before_or_equal' => 'La date de la facture doit être avant ou égale à la date actuelle.',
            
            'idClient.required' => 'Le client est obligatoire.',
            'idClient.exists' => 'Le client sélectionné n\'existe pas.',
        ];
        
        // Validation des données de la demande
        $request->validate([
            'DateFact' => 'required|date|before_or_equal:today', // Vérifie que la date est valide et dans le passé ou aujourd'hui
            'idClient' => 'required|exists:clients,id', // Vérifie que l'idClient existe bien dans la table clients
        ], $customMessages);
        
        // Création de la facture avec les données validées
        Facture::create($request->all());
        
        // Redirection avec un message de succès
        return redirect()->route('factures.index')
            ->with('success', 'Facture créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facture $facture)
    {
        // Charger la facture avec le client, le prospect, les éléments de la facture et les produits associés
        $facture->load('client.prospect', 'contenirs.produit');
    
        // Passer la facture, le client, le prospect, les éléments de la facture et les produits associés à la vue
        return view('factures.show', [
            'facture' => $facture,
            'client' => $facture->client,
            'prospect' => $facture->client->prospect,
            'contenirs' => $facture->contenirs, // Les éléments de la facture
            'produits' => $facture->contenirs->map(function($contenir) {
                return $contenir->produit; // Récupérer le produit lié à chaque élément
            })
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture)
    {
        $user = auth()->user();
        if($user->role !='manager'){
            return redirect()->route('factures.index')
                ->with('error', 'Vous n\'avez pas les droits pour supprimer une facture');
        }

        if ($facture->contenirs->isNotEmpty()) {
            return redirect()->route('factures.index')
                ->with('success', 'Impossible de supprimer, la facture est lié à du contenue');
        }
    
        // Supprimer le client
        $facture->delete();
    
        // Rediriger avec un message de succès après la suppression
        return redirect()->route('factures.index')
            ->with('success', 'Facture supprimé avec succès');
    }
    
}

