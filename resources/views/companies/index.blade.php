<x-layout>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fa-solid fa-building"></i> Companies</h1>
            <a href="#addCompany" class="btn btn-primary" data-bs-toggle="collapse">
                <i class="fa-solid fa-plus"></i> Add New Company
            </a>
        </div>

        @if($companies->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Recipient</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ Str::limit($company->address, 50) }}</td>
                                <td>{{ $company->recipient ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('companies.show', $company) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                title="Delete" 
                                                onclick="return confirm('Are you sure you want to delete this company?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">No companies found. Add your first company below.</div>
        @endif

        <div id="addCompany" class="collapse mt-4">
            <h2 class="text-center mb-4"><i class="fa-solid fa-plus"></i> Add New Company</h2>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="recipient" class="form-label">Recipient</label>
            <input type="text" class="form-control" id="recipient" name="recipient">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-layout>