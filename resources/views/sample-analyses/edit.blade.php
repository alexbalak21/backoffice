<x-layout>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Sample Analysis #{{ $sampleAnalysis->id }}</h1>
        <div>
            <a href="{{ route('sample-analyses.show', $sampleAnalysis) }}" class="btn btn-info">
                <i class="fa-solid fa-eye"></i> View
            </a>
            <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('sample-analyses._form')
</div>
</x-layout>
