<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EchantillonAnalyse extends Model
{
    use SoftDeletes;

    protected $table = 'echantillon_analyse';

    protected $fillable = [
        'nom_client',
        'date_heure_prelevement',
        'lieu_de_prelevement',
        'date_heure_reception',
        'temperature_reception',
        'conditions_conservation',
        'date_mise_en_analyse',
        'fournisseur_fabricant',
        'conditionnement',
        'agrement',
        'lot',
        'type_de_peche',
        'nom_de_produit',
        'espece',
        'origine',
        'date_emballage',
        'a_consommer_jusqu_au',
        'imp',
        'hx',
        'note_nucleotide',
        'rapport_genere',
        'ref_rapport'
    ];

    protected $casts = [
        'date_heure_prelevement' => 'datetime',
        'date_heure_reception' => 'datetime',
        'date_mise_en_analyse' => 'datetime',
        'date_emballage' => 'date',
        'a_consommer_jusqu_au' => 'date',
        'temperature_reception' => 'decimal:2',
        'rapport_genere' => 'boolean'
    ];
}
