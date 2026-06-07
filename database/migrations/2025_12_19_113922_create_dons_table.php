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
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom_donateur');
            $table->string('prenom_donateur');
            $table->string('contact_donateur');
            $table->string('email_donateur')->unique();
            $table->string('adresse_donateur');
            $table->dateTime('date_don');
            $table->string('montant_don');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dons');
    }
};
