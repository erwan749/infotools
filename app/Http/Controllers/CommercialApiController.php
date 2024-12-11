<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commercial;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class CommercialApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function login(Request $request)
    {
    
        $user = User::where('email', $request->email)->first();

        if (is_null($user)) {
            return response()->json([
                "success" => false,
                "message" => "L'utilisateur n'existe pas."
            ], 404);
        }

        if (Hash::check($request->psw, $user->password)) {
            return response()->json([
                "success" => true,
                "data" => [
                    "name" => $user->name,
                ]
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Mauvais mot de passe"
            ], 401);
        }
    }
}
