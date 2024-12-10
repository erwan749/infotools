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
            $table->id();
            $table->string('cpCom', 5); //
            $table->string('villeCom', 50); //
            $table->string('rueCom', 50); //
            $table->string('telCom', 50); //
            $table->bigInteger('idUser', 20); //
            $table->timestamps();
            
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
