<x-layout>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fa-solid fa-flask"></i> Analyses d'échantillons</h1>
        <div class="btn-group">
            <a href="/import-json" class="btn btn-outline-primary">
                <i class="fa-solid fa-file-import me-1"></i> Importer JSON
            </a>
            <a href="{{ route('sample-analyses.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus me-1"></i> Nouvelle analyse
            </a>
        </div>
    </div>

    <x-alert type="success" :autodismiss="4000" />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Produit</th>
                            <th>N° de lot</th>
                            <th>Date de prélèvement</th>
                            <th>Date d'analyse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sampleAnalyses as $analysis)
                            <tr>
                                <td>{{ $analysis->client ?? 'Non spécifié' }}</td>
                                <td>{{ $analysis->product_name ?? 'Non spécifié' }}</td>
                                <td>{{ $analysis->batch_number ?? 'Non spécifié' }}</td>
                                <td>{{ $analysis->sampling_date ? $analysis->sampling_date->format('d/m/Y') : 'Non spécifiée' }}</td>
                                <td>{{ $analysis->analysis_date ? $analysis->analysis_date->format('d/m/Y') : 'Non spécifiée' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('sample-analyses.show', $analysis) }}" class="btn btn-info" title="Voir">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('sample-analyses.edit', $analysis) }}" class="btn btn-warning" title="Modifier">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a href="{{ route('sample-analyses.export-pdf', $analysis) }}" class="btn btn-primary" title="Exporter en PDF" target="_blank">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                        <button type="button" class="btn btn-secondary" title="Copier" onclick="event.stopPropagation(); document.getElementById('clone-form-{{ $analysis->id }}').submit();">
                                            <i class="fa-solid fa-copy"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger rounded-end" title="Supprimer" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette analyse ?')) { document.getElementById('delete-form-{{ $analysis->id }}').submit(); }">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <form id="clone-form-{{ $analysis->id }}" action="{{ route('sample-analyses.clone', $analysis) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <form id="delete-form-{{ $analysis->id }}" action="{{ route('sample-analyses.destroy', $analysis) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune analyse trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($sampleAnalyses->hasPages())
                <div class="mt-4">
                    {{ $sampleAnalyses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
</x-layout>
