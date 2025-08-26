<x-layout>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fa-solid fa-flask"></i> Détails de l'analyse</h1>
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
                <h5 class="card-title">Analyse #{{ $sampleAnalysis->id }}</h5>
                
                <div class="mb-4">
                    <h6>Client</h6>
                    <p class="mb-0">{{ $sampleAnalysis->client ?? 'Non spécifié' }}</p>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6>Informations de prélèvement</h6>
                        <p><strong>Date :</strong> {{ $sampleAnalysis->sampling_date ? $sampleAnalysis->sampling_date->format('d/m/Y') : 'Non spécifiée' }}</p>
                        <p><strong>Lieu :</strong> {{ $sampleAnalysis->sampling_location ?? 'Non spécifié' }}</p>
                        
                        <h6 class="mt-4">Informations du produit</h6>
                        <p><strong>Nom :</strong> {{ $sampleAnalysis->product_name }}</p>
                        <p><strong>Espèce :</strong> {{ $sampleAnalysis->species }}</p>
                        <p><strong>Origine :</strong> {{ $sampleAnalysis->origin }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <h6>Détails du laboratoire</h6>
                        <p><strong>Reçu le :</strong> {{ $sampleAnalysis->lab_receipt_datetime ? $sampleAnalysis->lab_receipt_datetime->format('d/m/Y H:i') : 'Non spécifié' }}</p>
                        <p><strong>Température :</strong> {{ $sampleAnalysis->receipt_temperature ? number_format($sampleAnalysis->receipt_temperature, 2, ',', ' ') . '°C' : 'Non spécifiée' }}</p>
                        <p><strong>Stockage :</strong> {{ $sampleAnalysis->storage_conditions ?? 'Non spécifié' }}</p>
                        <p><strong>Analysé le :</strong> {{ $sampleAnalysis->analysis_date ? $sampleAnalysis->analysis_date->format('d/m/Y') : 'Non spécifié' }}</p>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6>Fournisseur et conditionnement</h6>
                        <p><strong>Fournisseur :</strong> {{ $sampleAnalysis->supplier_manufacturer }}</p>
                        <p><strong>Conditionnement :</strong> {{ $sampleAnalysis->packaging }}</p>
                        <p><strong>N° de lot :</strong> {{ $sampleAnalysis->batch_number }}</p>
                        @if($sampleAnalysis->packaging_date)
                        <p><strong>Date d'emballage :</strong> {{ $sampleAnalysis->packaging_date->format('d/m/Y') }}</p>
                        @endif
                        @if($sampleAnalysis->best_before_date)
                        <p><strong>À consommer jusqu'au :</strong> {{ $sampleAnalysis->best_before_date->format('d/m/Y') }}</p>
                        @endif
                        @if($sampleAnalysis->approval_number)
                            <p><strong>N° d'agrément :</strong> {{ $sampleAnalysis->approval_number }}</p>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <h6>Analyse des nucléotides</h6>
                        <p><strong>IMP :</strong> {{ $sampleAnalysis->imp }}</p>
                        <p><strong>Hx :</strong> {{ $sampleAnalysis->hx }}</p>
                        <p><strong>Note :</strong> {{ $sampleAnalysis->nucleotide_note ?? 'Aucune note' }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
            
            <div class="card-footer text-muted">
                <small>
                    Created: {{ $sampleAnalysis->created_at->format('Y-m-d H:i') }}
                    @if($sampleAnalysis->created_at != $sampleAnalysis->updated_at)
                        | Last updated: {{ $sampleAnalysis->updated_at->format('Y-m-d H:i') }}
                    @endif
                </small>
            </div>
        </div>
    </div>
</x-layout>
