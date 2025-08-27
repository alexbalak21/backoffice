<x-layout>
    <div class="container">
            <h1><i class="fa-solid fa-flask"></i> Import from JSON to DB</h1>
            <form action="{{ route('sample-analyses.import-json') }}" method="POST">
                <textarea name="json" id="" cols="30" rows="10"></textarea>
                @csrf
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
    </div>
</x-layout>