@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">PDF Document: {{ $pdf->client }}</h1>
            <p class="text-gray-600">Reference: {{ $pdf->ref }}</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('pdfs.edit', $pdf) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <a href="{{ route('pdfs.download', $pdf) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Download PDF
            </a>
            <a href="{{ route('pdfs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">HTML Preview</h2>
        <div class="border rounded p-4 bg-gray-50 overflow-auto max-h-96">
            {!! $pdf->html_content !!}
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Document Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="font-semibold">Client</h3>
                <p class="text-gray-700">{{ $pdf->client }}</p>
            </div>
            <div>
                <h3 class="font-semibold">Reference</h3>
                <p class="text-gray-700">{{ $pdf->ref }}</p>
            </div>
            <div>
                <h3 class="font-semibold">Created At</h3>
                <p class="text-gray-700">{{ $pdf->created_at->format('F j, Y, g:i a') }}</p>
            </div>
            <div>
                <h3 class="font-semibold">Last Updated</h3>
                <p class="text-gray-700">{{ $pdf->updated_at->format('F j, Y, g:i a') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
