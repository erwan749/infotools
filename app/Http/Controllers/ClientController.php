<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Prospect;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::with('prospect')->get();
        return view('clients.index', compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /**
         * Gestion des erreurs de saisie
         */
        $customMessages = [
            'Nom.required' => 'Vous devez entrer un nom.',
            'Prenom.required' => 'Vous devez entrer un prénom.',
            'Adresse.required' => 'Vous devez entrer une adresse.',
            'CP.required' => 'Vous devez entrer un code postal.',
            'Ville.required' => 'Vous devez entrer une ville.',
            'Email.required' => 'Vous devez entrer un email.',
            'Telephone.required' => 'Vous devez entrer un numéro de téléphone.',
            'psw.required' => 'Vous devez entrer un mot de passe.',
            'psw.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
            'psw.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.',
            'CP.digits' => 'Le code postal doit avoir 5 chiffres.',
            'Telephone.digits' => 'Le numéro de téléphone doit avoir 10 chiffres.',
            'Email.email' => 'Le format email n\'est pas respecté.',
            'Email.unique' => 'Cet email existe déjà.',
            'Telephone.unique' => 'Ce numéro de téléphone existe déjà.',
        ];
    
        // Validate the request data
        $request->validate([
            'Nom' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'Adresse' => 'required|string|max:255',
            'CP' => 'required|string|digits:5',
            'Ville' => 'required|string|max:255',
            'Email' => 'required|email|max:255|unique:prospects,EmailProspects',
            'Telephone' => 'required|string|digits:10|unique:prospects,telProspects',
            'psw' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        ], $customMessages);
    
        
        $psw = Hash::make($request->psw);

        $prospect = Prospect::create([
            'NomProspects' => $request->Nom,
            'PrenomProspects' => $request->Prenom,
            'telProspects' => $request->Telephone,
            'EmailProspects' => $request->Email,            
            'mdpProspect'=>$psw
        ]);

        $client = Client::create([
            'CPClient' => $request->CP,
            'VilleClient' => $request->Ville,
            'AdresseClient' => $request->Adresse,
            'idProspects' => $prospect->id,
        ]);

        return redirect()->route('clients.index')
            ->with('success','Client ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         // Récupérer le client par son ID avec la relation 'prospect'
    $client = Client::with('prospect')->findOrFail($id);
    
    // Retourner la vue 'clients.show' avec le client
    return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));//renvoye sur la page edit de client avec les donner d'un client selectionner 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
{
    /**
     * Gestion des erreurs de saisie
     */
    $customMessages = [
        'Nom.required' => 'Vous devez entrer un nom.',
        'Prenom.required' => 'Vous devez entrer un prénom.',
        'Adresse.required' => 'Vous devez entrer une adresse.',
        'CP.required' => 'Vous devez entrer un code postal.',
        'Ville.required' => 'Vous devez entrer une ville.',
        'Email.required' => 'Vous devez entrer un email.',
        'Telephone.required' => 'Vous devez entrer un numéro de téléphone.',
        'CP.digits' => 'Le code postal doit avoir 5 chiffres.',
        'Telephone.digits' => 'Le numéro de téléphone doit avoir 10 chiffres.',
        'Email.email' => 'Le format email n\'est pas respecté.',
        'Email.unique' => 'Cet email existe déjà.',
        'Telephone.unique' => 'Ce numéro de téléphone existe déjà.',
    ];

    // Validation des données envoyées
    $request->validate([
        'Nom' => 'required|string|max:255',
        'Prenom' => 'required|string|max:255',
        'Adresse' => 'required|string|max:255',
        'CP' => 'required|string|digits:5',
        'Ville' => 'required|string|max:255',
        'Email' => 'required|email|max:255|unique:prospects,EmailProspects,' . $client->prospect->id, // Ignore existing prospect email
        'Telephone' => 'required|string|digits:10|unique:prospects,telProspects,' . $client->prospect->id, // Ignore existing prospect phone
    ], $customMessages);

    // Mise à jour du prospect associé
    $client->prospect->update([
        'NomProspects' => $request->Nom,
        'PrenomProspects' => $request->Prenom,
        'EmailProspects' => $request->Email,
        'telProspects' => $request->Telephone,
    ]);

    // Mise à jour du client
    $client->update([
        'CPClient' => $request->CP,
        'VilleClient' => $request->Ville,
        'AdresseClient' => $request->Adresse,
    ]);

    return redirect()->route('clients.index')
        ->with('success', 'Client mis à jour avec succès');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
{
    // Vérifier si le client a des factures associées
    if ($client->factures->isNotEmpty()) {
        return redirect()->route('clients.index')
            ->with('success', 'Impossible de supprimer, client lié à une ou plusieurs factures');
    }

    // Supprimer le client
    $client->delete();

    // Rediriger avec un message de succès après la suppression
    return redirect()->route('clients.index')
        ->with('success', 'Client supprimé avec succès');
}

}
