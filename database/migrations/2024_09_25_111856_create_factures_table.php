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
        Schema::create('factures', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->dateTime('DateFact'); // Date et heure de la facture
            $table->unsignedBigInteger('idClient'); // Clé étrangère vers clients.id
            $table->timestamps(); // Colonnes created_at et updated_at

            // Définir la clé étrangère
            $table->foreign('idClient')
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
        Schema::dropIfExists('factures');
    }
};
