<x-layout>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fa-solid fa-building"></i> Company Details</h1>
            <div>
                <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">
                    <i class="fa-solid fa-edit"></i> Edit
                </a>
                <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete this company?')">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $company->name }}</h5>
                <div class="mb-3">
                    <h6>Address:</h6>
                    <p class="card-text" style="white-space: pre-line;">{{ $company->address }}</p>
                </div>
                @if($company->recipient)
                <div class="mb-3">
                    <h6>Recipient:</h6>
                    <p class="card-text">{{ $company->recipient }}</p>
                </div>
                @endif
                <div class="mt-4">
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
