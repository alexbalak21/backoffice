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
        Schema::table('sample_analyses', function (Blueprint $table) {
            $table->dateTime('sampling_date')->nullable()->change();
            $table->string('sampling_location')->nullable()->change();
            $table->dateTime('lab_receipt_datetime')->nullable()->change();
            $table->decimal('receipt_temperature', 5, 2)->nullable()->change();
            $table->text('storage_conditions')->nullable()->change();
            $table->dateTime('analysis_date')->nullable()->change();
            $table->string('supplier_manufacturer')->nullable()->change();
            $table->string('packaging')->nullable()->change();
            $table->string('approval_number')->nullable()->change();
            $table->string('batch_number')->nullable()->change();
            $table->string('fishing_type')->nullable()->change();
            $table->string('product_name')->nullable()->change();
            $table->string('species')->nullable()->change();
            $table->string('origin')->nullable()->change();
            $table->date('packaging_date')->nullable()->change();
            $table->date('best_before_date')->nullable()->change();
            $table->string('imp')->nullable()->change();
            $table->string('hx')->nullable()->change();
            $table->text('nucleotide_note')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample_analyses', function (Blueprint $table) {
            $table->dateTime('sampling_date')->nullable(false)->change();
            $table->string('sampling_location')->nullable(false)->change();
            $table->dateTime('lab_receipt_datetime')->nullable(false)->change();
            $table->decimal('receipt_temperature', 5, 2)->nullable(false)->change();
            $table->text('storage_conditions')->nullable(false)->change();
            $table->dateTime('analysis_date')->nullable(false)->change();
            $table->string('supplier_manufacturer')->nullable(false)->change();
            $table->string('packaging')->nullable(false)->change();
            $table->string('approval_number')->nullable(false)->change();
            $table->string('batch_number')->nullable(false)->change();
            $table->string('fishing_type')->nullable(false)->change();
            $table->string('product_name')->nullable(false)->change();
            $table->string('species')->nullable(false)->change();
            $table->string('origin')->nullable(false)->change();
            $table->date('packaging_date')->nullable(false)->change();
            $table->date('best_before_date')->nullable(false)->change();
            $table->string('imp')->nullable(false)->change();
            $table->string('hx')->nullable(false)->change();
            $table->text('nucleotide_note')->nullable(false)->change();
        });
    }
};
