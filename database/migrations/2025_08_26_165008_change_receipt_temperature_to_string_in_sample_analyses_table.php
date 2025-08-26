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
            $table->string('receipt_temperature', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample_analyses', function (Blueprint $table) {
            $table->decimal('receipt_temperature', 5, 2)->change();
        });
    }
};
