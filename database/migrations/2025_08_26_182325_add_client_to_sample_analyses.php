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
            if (Schema::hasColumn('sample_analyses', 'client')) {
                $table->dropColumn('client');
            }
        });
    }
};
