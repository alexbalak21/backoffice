<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get a raw database connection
        $connection = DB::connection();
        
        // Check if SQLite is being used
        if ($connection->getDriverName() === 'sqlite') {
            // For SQLite, we need to recreate the table to drop columns
            $connection->statement('PRAGMA foreign_keys=off;');
            
            // Create a temporary table with the new schema
            $connection->statement('CREATE TABLE sample_analyses_temp (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                client TEXT NULL,
                sampling_date DATETIME NULL,
                sampling_location VARCHAR(255) NULL,
                lab_receipt_datetime DATETIME NULL,
                receipt_temperature DECIMAL(8,2) NULL,
                storage_conditions TEXT NULL,
                analysis_date DATETIME NULL,
                supplier_manufacturer VARCHAR(255) NULL,
                packaging VARCHAR(255) NULL,
                approval_number VARCHAR(255) NULL,
                batch_number VARCHAR(255) NULL,
                fishing_type VARCHAR(255) NULL,
                product_name VARCHAR(255) NULL,
                species VARCHAR(255) NULL,
                origin VARCHAR(255) NULL,
                packaging_date DATE NULL,
                best_before_date DATE NULL,
                imp VARCHAR(255) NULL,
                hx VARCHAR(255) NULL,
                nucleotide_note TEXT NULL,
                created_at DATETIME NULL,
                updated_at DATETIME NULL
            )');
            
            // Copy data from old table to new table
            $connection->statement('INSERT INTO sample_analyses_temp (
                id, sampling_date, sampling_location, lab_receipt_datetime, receipt_temperature, 
                storage_conditions, analysis_date, supplier_manufacturer, packaging, approval_number, 
                batch_number, fishing_type, product_name, species, origin, packaging_date, 
                best_before_date, imp, hx, nucleotide_note, created_at, updated_at
            ) SELECT 
                id, sampling_date, sampling_location, lab_receipt_datetime, receipt_temperature, 
                storage_conditions, analysis_date, supplier_manufacturer, packaging, approval_number, 
                batch_number, fishing_type, product_name, species, origin, packaging_date, 
                best_before_date, imp, hx, nucleotide_note, created_at, updated_at 
            FROM sample_analyses');
            
            // Drop the old table
            $connection->statement('DROP TABLE sample_analyses');
            
            // Rename the new table
            $connection->statement('ALTER TABLE sample_analyses_temp RENAME TO sample_analyses');
            
            // Re-enable foreign keys
            $connection->statement('PRAGMA foreign_keys=on;');
        } else {
            // For other databases, use standard SQL
            Schema::table('sample_analyses', function (Blueprint $table) {
                // Drop foreign key constraint if it exists
                $table->dropForeign(['client_id']);
                
                // Drop the client_id column
                $table->dropColumn('client_id');
                
                // Add the client column if it doesn't exist
                if (!Schema::hasColumn('sample_analyses', 'client')) {
                    $table->string('client')->nullable()->after('id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is a one-way migration, so we'll leave this empty
        // Reverting would require restoring from a backup or a more complex migration
    }
};
