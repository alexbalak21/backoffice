@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">{{ isset($pdf) ? 'Edit' : 'Create' }} PDF Document</h1>

    <form action="{{ isset($pdf) ? route('pdfs.update', $pdf) : route('pdfs.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @if(isset($pdf))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="client">
                Client Name
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="client" name="client" type="text" 
                   value="{{ old('client', $pdf->client ?? '') }}" required>
            @error('client')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="html_content">
                HTML Content
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                      id="html_content" name="html_content" rows="10" 
                      required>{{ old('html_content', $pdf->html_content ?? '') }}</textarea>
            @error('html_content')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            <p class="text-gray-600 text-xs italic mt-1">Enter the HTML that will be used to generate the PDF.</p>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('pdfs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ isset($pdf) ? 'Update' : 'Create' }} PDF
            </button>
        </div>
    </form>
</div>
@endsection
