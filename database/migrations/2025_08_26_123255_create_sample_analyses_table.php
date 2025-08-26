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
        Schema::create('sample_analyses', function (Blueprint $table) {
            $table->id();
            // Date et lieu de prélèvement
            $table->date('sampling_date');
            $table->string('sampling_location');
            
            // Date, heure et T°C à la réception au laboratoire
            $table->dateTime('lab_receipt_datetime');
            $table->decimal('receipt_temperature', 5, 2);
            
            // Conditions de conservation à la réception
            $table->text('storage_conditions');
            
            // Date de mise en analyse
            $table->date('analysis_date');
            
            // Fournisseur/Fabricant
            $table->string('supplier_manufacturer');
            
            // Conditionnement
            $table->string('packaging');
            
            // Agrément
            $table->string('approval_number');
            
            // Lot
            $table->string('batch_number');
            
            // Type de pêche
            $table->string('fishing_type');
            
            // Nom de produit
            $table->string('product_name');
            
            // Espèce
            $table->string('species');
            
            // Origine
            $table->string('origin');
            
            // Date d'emballage
            $table->date('packaging_date');
            
            // A consommer jusqu'au
            $table->date('best_before_date');
            
            // IMP, HX, Note Nucléotide
            $table->string('imp');
            $table->string('hx');
            $table->text('nucleotide_note')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_analyses');
    }
};
