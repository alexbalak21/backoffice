<x-layout>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ session('old') ? 'Review Copied Analysis' : 'Add New Sample Analysis' }}</h1>
        <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to List
        </a>
    </div>

    <x-alert type="success" :autodismiss="4000" />
    <x-alert type="danger" :autodismiss="4000" />

    @include('sample-analyses._form', ['sampleAnalysis' => session('old')])
</div>
</x-layout>
