<?php

namespace App\Http\Controllers;

use App\Models\Rdv;
use App\Models\Client;
use App\Models\Commercial; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RdvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté

    // Vérifie le rôle de l'utilisateur
        if ($user->role == 'manager') {
            // Si l'utilisateur est un manager, récupère tous les rendez-vous
            $rdv = Rdv::with(['commercial.user', 'client.prospect'])->get();
        } else {
            // Si l'utilisateur n'est pas un manager, récupère les rendez-vous associés à lui via la table commercial
            $rdv = Rdv::with(['commercial.user', 'client.prospect'])
                    ->whereHas('commercial', function($query) use ($user) {
                        // On filtre sur le commercial en fonction de l'idUser de l'utilisateur connecté
                        $query->where('idUser', $user->id);
                    })
                    ->get();
        }
        
        // Mapper les données pour inclure les informations du commercial, du client et de l'utilisateur
        $rdvData = $rdv->map(function ($rdv) {
            return [
                'id' => $rdv->id, 
                'DateRdv' => $rdv->DateRdv, 
                'commercial' => [
                    'name' => $rdv->commercial && $rdv->commercial->user ? $rdv->commercial->user->name : 'Nom indisponible',
                ],
                'client' => [
                    'nom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->NomProspects : 'Nom indisponible', 
                    'prenom' => $rdv->client && $rdv->client->prospect ? $rdv->client->prospect->PrenomProspects : 'Prénom indisponible', 
                ],
            ];
        });
        return view('rdv.index', compact('rdvData'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Récupérer le commercial connecté
    $commercial = Commercial::where('idUser', auth()->id())->first();

    if (!$commercial) {
        return redirect()->route('rdv.index')->withErrors(['error' => 'Commercial non trouvé.']);
    }

    // Récupérer les rendez-vous du commercial connecté
    $rdvs = Rdv::where('NoCom', $commercial->id)->get(['DateRdv']);

    return view('rdv.create', [
        'clients' => Client::all(),
        'occupiedDates' => $rdvs->map(function ($rdv) {
            $start = \Carbon\Carbon::parse($rdv->DateRdv);
            $end = $start->clone()->addMinutes(30);
            return [
                'start' => $start->format('Y-m-d\TH:i'),
                'end' => $end->format('Y-m-d\TH:i'),
            ];
        }),
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'DateRdv' => 'required|date',
            'client_id' => 'required|exists:clients,id',
        ], [
            'DateRdv.required' => 'La date du rendez-vous est obligatoire.',
            'client_id.required' => 'Veuillez sélectionner un client.',
            'client_id.exists' => 'Le client sélectionné est invalide.',
        ]);
    
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier si l'utilisateur est associé à un commercial
        $commercial = $user->commercial;
        if (!$commercial) {
            return redirect()->back()->withErrors([
                'commercial' => 'L’utilisateur connecté n’est pas associé à un commercial.'
            ])->withInput();
        }
    
        // Créer un nouveau rendez-vous
        Rdv::create([
            'DateRdv' => $validatedData['DateRdv'],
            'NoClient' => $validatedData['client_id'],
            'NoCom' => $commercial->id, // Associer le commercial connecté
        ]);
    
        // Rediriger avec un message de succès
        return redirect()->route('rdv.index')->with('success', 'Rendez-vous ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rdv $rdv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rdv $rdv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rdv $rdv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rdv $rdv)
    {
        //
    }
}
