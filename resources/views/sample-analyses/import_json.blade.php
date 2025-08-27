<x-layout>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="h5 mb-0"><i class="fas fa-file-import me-2"></i>Import Sample Analyses from JSON</h1>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                        @if(session()->has('errors'))
                            <ul class="mb-0 mt-2">
                                @foreach(session('errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sample-analyses.import-json.submit') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="jsonData" class="form-label">Paste your JSON data below:</label>
                        <textarea 
                            class="form-control font-monospace" 
                            name="json" 
                            id="jsonData" 
                            rows="15" 
                            placeholder='[
  {
    "client": "Client Name",
    "product_name": "Product Name",
    "batch_number": "BATCH-001",
    "sampling_date": "2025-08-27",
    "analysis_date": "2025-08-28",
    "species": "Species Name",
    "origin": "Country of Origin"
  }
]'
                            required
                        >{{ old('json') }}</textarea>
                        <div class="form-text">
                            <p class="mb-1">Format: Single object or array of objects with analysis data.</p>
                            <p class="mb-0">Required fields: client, product_name, batch_number</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-1"></i> Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-format JSON when pasting
        document.getElementById('jsonData').addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text');
            try {
                const json = JSON.parse(text);
                this.value = JSON.stringify(json, null, 2);
            } catch (e) {
                // If not valid JSON, just paste as is
                this.value = text;
            }
        });
    </script>
    @endpush
</x-layout>
