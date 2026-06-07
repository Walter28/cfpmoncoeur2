<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('contact')->nullable()->change();
            $table->string('adresse')->nullable()->change();
            $table->date('date_naissance')->nullable()->change();
            $table->string('sexe')->nullable()->change();
            $table->string('photo')->nullable()->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->string('contact')->nullable(false)->change();
            $table->string('adresse')->nullable(false)->change();
            $table->date('date_naissance')->nullable(false)->change();
            $table->string('sexe')->nullable(false)->change();
        });
    }
};
