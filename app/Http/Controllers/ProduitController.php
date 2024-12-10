<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use Illuminate\Http\Request;


class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $customMessages = [
            'typeProd.required' => 'Vous devez entrer un type de produit.',
            'typeProd.string' => 'Le type de produit doit être une chaîne de caractères.',
            'typeProd.max' => 'Le type de produit ne peut pas dépasser 255 caractères.',
            
            'prixProd.required' => 'Vous devez entrer un prix.',
            'prixProd.numeric' => 'Le prix doit être un nombre a virgule.',
            'prixProd.min' => 'Le prix doit être supérieur ou égal à 0.',
        
            'nomProd.required' => 'Vous devez entrer un nom de produit.',
            'nomProd.string' => 'Le nom du produit doit être une chaîne de caractères.',
            'nomProd.max' => 'Le nom du produit ne peut pas dépasser 255 caractères.',
        
            'descProd.required' => 'Vous devez entrer une description de produit.',
            'descProd.string' => 'La description du produit doit être une chaîne de caractères.',
            'descProd.max' => 'La description du produit ne peut pas dépasser 255 caractères.',
        ];
        
        // Validate the request data for the 'Produit' form
        $request->validate([
            'typeProd' => 'required|string|max:255',
            'prixProd' => 'required|numeric|min:0',
            'nomProd' => 'required|string|max:255',
            'descProd' => 'required|string|max:255',
        ], $customMessages);
        

        Produit::create($request->all());
        return redirect()->route('produits.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $customMessages = [
            'typeProd.required' => 'Vous devez entrer un type de produit.',
            'typeProd.string' => 'Le type de produit doit être une chaîne de caractères.',
            'typeProd.max' => 'Le type de produit ne peut pas dépasser 255 caractères.',
            
            'prixProd.required' => 'Vous devez entrer un prix.',
            'prixProd.numeric' => 'Le prix doit être un nombre a virgule.',
            'prixProd.min' => 'Le prix doit être supérieur ou égal à 0.',
        
            'nomProd.required' => 'Vous devez entrer un nom de produit.',
            'nomProd.string' => 'Le nom du produit doit être une chaîne de caractères.',
            'nomProd.max' => 'Le nom du produit ne peut pas dépasser 255 caractères.',
        
            'descProd.required' => 'Vous devez entrer une description de produit.',
            'descProd.string' => 'La description du produit doit être une chaîne de caractères.',
            'descProd.max' => 'La description du produit ne peut pas dépasser 255 caractères.',
        ];
        
        // Validate the request data for the 'Produit' form
        $request->validate([
            'typeProd' => 'required|string|max:255',
            'prixProd' => 'required|numeric|min:0',
            'nomProd' => 'required|string|max:255',
            'descProd' => 'required|string|max:255',
        ], $customMessages);

        $produit->update($request->all());
        return redirect()->route('produits.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}
