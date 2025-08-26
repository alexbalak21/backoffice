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
            // Drop foreign key constraint if it exists
            $table->dropForeign(['client_id']);
            
            // Drop the client_id column
            $table->dropColumn('client_id');
            
            // Ensure client column exists and is properly configured
            if (!Schema::hasColumn('sample_analyses', 'client')) {
                $table->string('client')->nullable()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample_analyses', function (Blueprint $table) {
            // Re-add client_id column
            if (!Schema::hasColumn('sample_analyses', 'client_id')) {
                $table->foreignId('client_id')
                    ->nullable()
                    ->constrained('companies')
                    ->nullOnDelete();
            }
            
            // Drop client column if it exists
            if (Schema::hasColumn('sample_analyses', 'client')) {
                $table->dropColumn('client');
            }
        });
    }
};
