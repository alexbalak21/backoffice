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
        // First, check if the client column exists and remove it
        if (Schema::hasColumn('sample_analyses', 'client')) {
            Schema::table('sample_analyses', function (Blueprint $table) {
                $table->dropColumn('client');
            });
        }
        
        // Add the client column as a simple string
        Schema::table('sample_analyses', function (Blueprint $table) {
            $table->string('client')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample_analyses', function (Blueprint $table) {
            $table->dropColumn('client');
        });
    }
};
