<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleAnalysis extends Model
{
    protected $fillable = [
        'client',
        'sampling_date',
        'sampling_location',
        'lab_receipt_datetime',
        'receipt_temperature',
        'storage_conditions',
        'analysis_date',
        'supplier_manufacturer',
        'packaging',
        'approval_number',
        'batch_number',
        'fishing_type',
        'product_name',
        'species',
        'origin',
        'packaging_date',
        'best_before_date',
        'imp',
        'hx',
        'nucleotide_note'
    ];

    protected $casts = [
        'sampling_date' => 'datetime',
        'lab_receipt_datetime' => 'datetime',
        'analysis_date' => 'datetime',
        'packaging_date' => 'date',
        'best_before_date' => 'date',
        'receipt_temperature' => 'decimal:2'
    ];

    // Client is now a simple string field
}
