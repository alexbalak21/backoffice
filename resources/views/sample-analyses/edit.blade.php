@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Sample Analysis #{{ $sampleAnalysis->id }}</h1>
        <div>
            <a href="{{ route('sample-analyses.show', $sampleAnalysis) }}" class="btn btn-info">View</a>
            <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">Back to List</a>
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
@endsection
