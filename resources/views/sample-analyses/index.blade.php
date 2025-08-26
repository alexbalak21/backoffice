<x-layout>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Sample Analyses</h1>
        <a href="{{ route('sample-analyses.create') }}" class="btn btn-primary">Add New Analysis</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Batch Number</th>
                            <th>Sampling Date</th>
                            <th>Analysis Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sampleAnalyses as $analysis)
                            <tr>
                                <td>{{ $analysis->id }}</td>
                                <td>{{ $analysis->product_name }}</td>
                                <td>{{ $analysis->batch_number }}</td>
                                <td>{{ $analysis->sampling_date->format('Y-m-d') }}</td>
                                <td>{{ $analysis->analysis_date->format('Y-m-d') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('sample-analyses.show', $analysis) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('sample-analyses.edit', $analysis) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('sample-analyses.destroy', $analysis) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No sample analyses found.</td>
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
