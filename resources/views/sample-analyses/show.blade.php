<x-layout>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fa-solid fa-flask"></i> Détails de l'analyse #{{ $sampleAnalysis->id }}</h1>
            <div>
                <a href="{{ route('sample-analyses.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nouvelle analyse
                </a>
                <a href="{{ route('sample-analyses.edit', $sampleAnalysis) }}" class="btn btn-warning">
                    <i class="fa-solid fa-edit"></i> Modifier
                </a>
                <form action="{{ route('sample-analyses.clone', $sampleAnalysis) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary" 
                            onclick="return confirm('Voulez-vous vraiment copier cette analyse ?')">
                        <i class="fa-solid fa-copy"></i> Copier
                    </button>
                </form>
                <form action="{{ route('sample-analyses.destroy', $sampleAnalysis) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette analyse ?')">
                        <i class="fa-solid fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h5>Client</h5>
                            <p class="mb-0">{{ $sampleAnalysis->client ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Date et lieu de prélèvement</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Date et heure de prélèvement :</strong></p>
                            <p>{{ $sampleAnalysis->sampling_date ? $sampleAnalysis->sampling_date->format('d/m/Y H:i') : 'Non spécifiée' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Lieu de prélèvement :</strong></p>
                            <p>{{ $sampleAnalysis->sampling_location ?? 'Non spécifié' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Date, heure et T°C à la réception au laboratoire</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Date et heure de réception :</strong></p>
                            <p>{{ $sampleAnalysis->lab_receipt_datetime ? $sampleAnalysis->lab_receipt_datetime->format('d/m/Y H:i') : 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Température à la réception :</strong></p>
                            <p>{{ $sampleAnalysis->receipt_temperature ? number_format($sampleAnalysis->receipt_temperature, 2, ',', ' ') . ' °C' : 'Non spécifiée' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Conditions de conservation :</strong></p>
                            <p>{{ $sampleAnalysis->storage_conditions ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Date et heure de mise en analyse :</strong></p>
                            <p>{{ $sampleAnalysis->analysis_date ? $sampleAnalysis->analysis_date->format('d/m/Y H:i') : 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Informations sur le produit</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Fournisseur/Fabricant :</strong></p>
                            <p>{{ $sampleAnalysis->supplier_manufacturer ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Conditionnement :</strong></p>
                            <p>{{ $sampleAnalysis->packaging ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>N° d'agrément :</strong></p>
                            <p>{{ $sampleAnalysis->approval_number ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>N° de lot :</strong></p>
                            <p>{{ $sampleAnalysis->batch_number ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Type de pêche :</strong></p>
                            <p>{{ $sampleAnalysis->analysis_type ?? 'Non spécifié' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Informations supplémentaires</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Nom du produit :</strong></p>
                            <p>{{ $sampleAnalysis->product_name ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Espèce :</strong></p>
                            <p>{{ $sampleAnalysis->species ?? 'Non spécifiée' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Origine :</strong></p>
                            <p>{{ $sampleAnalysis->origin ?? 'Non spécifiée' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Date d'emballage :</strong></p>
                            <p>{{ $sampleAnalysis->packaging_date ? $sampleAnalysis->packaging_date->format('d/m/Y') : 'Non spécifiée' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>À consommer jusqu'au :</strong></p>
                            <p>{{ $sampleAnalysis->best_before_date ? $sampleAnalysis->best_before_date->format('d/m/Y') : 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>IMP :</strong></p>
                            <p>{{ $sampleAnalysis->imp ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>HX :</strong></p>
                            <p>{{ $sampleAnalysis->hx ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Note sur les nucléotides :</strong></p>
                            <p>{{ $sampleAnalysis->nucleotide_note ? nl2br(e($sampleAnalysis->nucleotide_note)) : 'Aucune note' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
            
            <div class="card-footer text-muted">
                <small>
                    Créé le : {{ $sampleAnalysis->created_at->format('d/m/Y H:i') }}
                    @if($sampleAnalysis->created_at != $sampleAnalysis->updated_at)
                        | Dernière mise à jour : {{ $sampleAnalysis->updated_at->format('d/m/Y H:i') }}
                    @endif
                </small>
            </div>
        </div>
    </div>
</x-layout>
