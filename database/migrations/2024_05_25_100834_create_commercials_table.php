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
        Schema::create('commercials', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('cpCom', 5); // Code postal
            $table->string('villeCom', 50); // Ville
            $table->string('rueCom', 50); // Rue
            $table->string('telCom', 50); // Téléphone
            $table->unsignedBigInteger('idUser'); // Clé étrangère vers users.id
            $table->timestamps(); // Colonnes created_at et updated_at

            // Déclaration de la clé étrangère
            $table->foreign('idUser')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Suppression en cascade
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercials');
    }
};
