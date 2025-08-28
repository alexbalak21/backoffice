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
        Schema::create('echantillon_analyse', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client')->nullable();
            $table->dateTime('date_heure_prelevement')->nullable();
            $table->string('lieu_de_prelevement')->nullable();
            $table->dateTime('date_heure_reception')->nullable();
            $table->decimal('temperature_reception', 5, 2)->nullable();
            $table->string('conditions_conservation')->nullable();
            $table->dateTime('date_mise_en_analyse')->nullable();
            $table->string('fournisseur_fabricant')->nullable();
            $table->string('conditionnement')->nullable();
            $table->string('agrement')->nullable();
            $table->string('lot')->nullable();
            $table->string('type_de_peche')->nullable();
            $table->string('nom_de_produit')->nullable();
            $table->string('espece')->nullable();
            $table->string('origine')->nullable();
            $table->date('date_emballage')->nullable();
            $table->date('a_consommer_jusqu_au')->nullable();
            $table->string('imp')->nullable();
            $table->string('hx')->nullable();
            $table->text('note_nucleotide')->nullable();
            $table->boolean('rapport_genere')->default(false);
            $table->string('ref_rapport')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('echantillon_analyse');
    }
};
