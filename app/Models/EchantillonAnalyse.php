<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EchantillonAnalyse extends Model
{
    use SoftDeletes;

    protected $table = 'echantillon_analyse';
    
    // Explicitly define the column name to avoid any ambiguity
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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_heure_prelevement',
        'date_heure_reception',
        'date_mise_en_analyse',
        'date_emballage',
        'a_consommer_jusqu_au',
    ];

    /**
     * Parse the date_heure_prelevement attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateHeurePrelevementAttribute($value)
    {
        $this->attributes['date_heure_prelevement'] = $value ? \Carbon\Carbon::createFromFormat('d/m/y H:i', $value) : null;
    }

    /**
     * Parse the date_heure_reception attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateHeureReceptionAttribute($value)
    {
        $this->attributes['date_heure_reception'] = $value ? \Carbon\Carbon::createFromFormat('d/m/y H:i', $value) : null;
    }

    /**
     * Parse the date_mise_en_analyse attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateMiseEnAnalyseAttribute($value)
    {
        $this->attributes['date_mise_en_analyse'] = $value ? \Carbon\Carbon::createFromFormat('d/m/y H:i', $value) : null;
    }

    /**
     * Parse the date_emballage attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateEmballageAttribute($value)
    {
        $this->attributes['date_emballage'] = $value ? \Carbon\Carbon::createFromFormat('d/m/y', $value) : null;
    }

    /**
     * Parse the a_consommer_jusqu_au attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setAConsommerJusquAuAttribute($value)
    {
        $this->attributes['a_consommer_jusqu_au'] = $value ? \Carbon\Carbon::createFromFormat('d/m/y', $value) : null;
    }

    /**
     * Format date_heure_prelevement for display.
     *
     * @param  mixed  $value
     * @return string|null
     */
    /**
     * Format date_heure_prelevement for display.
     *
     * @param  mixed  $value
     * @return string|null
     */
    public function getDateHeurePrelevementAttribute($value)
    {
        if (!$value) return null;
        $date = is_string($value) ? \Carbon\Carbon::parse($value) : $value;
        return $date->format('d/m/y H:i');
    }

    /**
     * Format date_heure_reception for display.
     *
     * @param  mixed  $value
     * @return string|null
     */
    public function getDateHeureReceptionAttribute($value)
    {
        if (!$value) return null;
        $date = is_string($value) ? \Carbon\Carbon::parse($value) : $value;
        return $date->format('d/m/y H:i');
    }

    /**
     * Format date_mise_en_analyse for display.
     *
     * @param  mixed  $value
     * @return string|null
     */
    public function getDateMiseEnAnalyseAttribute($value)
    {
        if (!$value) return null;
        $date = is_string($value) ? \Carbon\Carbon::parse($value) : $value;
        return $date->format('d/m/y H:i');
    }

    /**
     * Format date_emballage for display.
     *
     * @param  mixed  $value
     * @return string|null
     */
    public function getDateEmballageAttribute($value)
    {
        if (!$value) return null;
        $date = is_string($value) ? \Carbon\Carbon::parse($value) : $value;
        return $date->format('d/m/y');
    }

    /**
     * Format a_consommer_jusqu_au for display.
     *
     * @param  mixed  $value
     * @return string|null
     */
    public function getAConsommerJusquAuAttribute($value)
    {
        if (!$value) return null;
        $date = is_string($value) ? \Carbon\Carbon::parse($value) : $value;
        return $date->format('d/m/y');
    }
}
