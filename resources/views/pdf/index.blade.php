<x-layout>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3">PDF Reports</h1>
                    <a href="{{ route('pdfs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create New Report
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Reference</th>
                                <th>Created At</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pdfs as $pdf)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pdf->client }}</td>
                                    <td>{{ $pdf->ref }}</td>
                                    <td>{{ $pdf->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pdfs.show', $pdf) }}" class="btn btn-sm btn-info text-white" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pdfs.edit', $pdf) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('pdfs.download', $pdf) }}" class="btn btn-sm btn-success" title="Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <form action="{{ route('pdfs.destroy', $pdf) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this report?')" 
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                            <p class="mb-0">No reports found. Create your first report!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pdfs->hasPages())
                    <div class="mt-4">
                        {{ $pdfs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>