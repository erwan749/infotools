<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rdv', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->dateTime('DateRdv'); // Date et heure du rendez-vous
            $table->unsignedBigInteger('NoCom'); // Clé étrangère vers commercials.id
            $table->unsignedBigInteger('NoClient'); // Clé étrangère vers clients.id
            $table->timestamps(); // Colonnes created_at et updated_at

            // Définir les clés étrangères
            $table->foreign('NoCom')
                  ->references('id')
                  ->on('commercials')
                  ->onDelete('cascade'); // Suppression en cascade si un commercial est supprimé

            $table->foreign('NoClient')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('cascade'); // Suppression en cascade si un client est supprimé
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdvs');
    }
};
