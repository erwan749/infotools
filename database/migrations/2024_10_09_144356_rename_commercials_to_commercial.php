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
        Schema::table('commercial', function (Blueprint $table) {
            Schema::rename('commercials', 'commercial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commercial', function (Blueprint $table) {
            Schema::rename('commercial', 'commercials');//
        });
    }
};
