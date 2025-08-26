<x-layout>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fa-solid fa-flask"></i> Sample Analysis Details</h1>
            <div>
                <a href="{{ route('sample-analyses.edit', $sampleAnalysis) }}" class="btn btn-warning">
                    <i class="fa-solid fa-edit"></i> Edit
                </a>
                <form action="{{ route('sample-analyses.destroy', $sampleAnalysis) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this analysis?')">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Analysis #{{ $sampleAnalysis->id }}</h5>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6>Sampling Information</h6>
                        <p><strong>Date:</strong> {{ $sampleAnalysis->sampling_date->format('Y-m-d') }}</p>
                        <p><strong>Location:</strong> {{ $sampleAnalysis->sampling_location }}</p>
                        
                        <h6 class="mt-4">Product Information</h6>
                        <p><strong>Name:</strong> {{ $sampleAnalysis->product_name }}</p>
                        <p><strong>Species:</strong> {{ $sampleAnalysis->species }}</p>
                        <p><strong>Origin:</strong> {{ $sampleAnalysis->origin }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <h6>Laboratory Details</h6>
                        <p><strong>Received:</strong> {{ $sampleAnalysis->lab_receipt_datetime->format('Y-m-d H:i') }}</p>
                        <p><strong>Temperature:</strong> {{ number_format($sampleAnalysis->receipt_temperature, 2) }}°C</p>
                        <p><strong>Storage:</strong> {{ $sampleAnalysis->storage_conditions }}</p>
                        <p><strong>Analyzed:</strong> {{ $sampleAnalysis->analysis_date->format('Y-m-d') }}</p>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6>Supplier & Packaging</h6>
                        <p><strong>Supplier:</strong> {{ $sampleAnalysis->supplier_manufacturer }}</p>
                        <p><strong>Packaging:</strong> {{ $sampleAnalysis->packaging }}</p>
                        <p><strong>Batch:</strong> {{ $sampleAnalysis->batch_number }}</p>
                        @if($sampleAnalysis->approval_number)
                            <p><strong>Approval:</strong> {{ $sampleAnalysis->approval_number }}</p>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <h6>Nucleotide Analysis</h6>
                        <p><strong>IMP:</strong> {{ $sampleAnalysis->imp }}</p>
                        <p><strong>Hx:</strong> {{ $sampleAnalysis->hx }}</p>
                        <p><strong>Note:</strong> {{ $sampleAnalysis->nucleotide_note }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back to List
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
