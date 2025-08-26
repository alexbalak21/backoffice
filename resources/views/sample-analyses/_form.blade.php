@if(isset($sampleAnalysis))
    <form action="{{ route('sample-analyses.update', $sampleAnalysis) }}" method="POST">
    @method('PUT')
@else
    <form action="{{ route('sample-analyses.store') }}" method="POST">
@endif
@csrf

<div class="row">
    <div class="col-md-6">
        <h4>Date et lieu de prélèvement</h4>
        <div class="form-group">
            <label for="sampling_date">Date et heure de prélèvement</label>
            <input type="datetime-local" name="sampling_date" id="sampling_date" class="form-control" value="{{ isset($sampleAnalysis->sampling_date) ? \Carbon\Carbon::parse($sampleAnalysis->sampling_date)->format('Y-m-d\TH:i') : old('sampling_date') }}">
        </div>
        <div class="form-group">
            <label for="sampling_location">Lieu de prélèvement</label>
            <input type="text" name="sampling_location" id="sampling_location" class="form-control" value="{{ $sampleAnalysis->sampling_location ?? old('sampling_location') }}">
        </div>
    </div>

    <div class="col-md-6">
        <h4>Date, heure et T°C à la réception au laboratoire</h4>
        <div class="form-group">
            <label for="lab_receipt_datetime">Date et heure de réception</label>
            <input type="datetime-local" name="lab_receipt_datetime" id="lab_receipt_datetime" class="form-control" value="{{ $sampleAnalysis->lab_receipt_datetime ?? old('lab_receipt_datetime') }}">
        </div>
        <div class="form-group">
            <label for="receipt_temperature">Température à la réception (°C)</label>
            <input type="number" name="receipt_temperature" id="receipt_temperature" class="form-control" step="0.01" value="{{ $sampleAnalysis->receipt_temperature ?? old('receipt_temperature') }}">
        </div>
        <div class="form-group">
            <label for="storage_conditions">Conditions de conservation</label>
            <textarea name="storage_conditions" id="storage_conditions" class="form-control" rows="2">{{ $sampleAnalysis->storage_conditions ?? old('storage_conditions') }}</textarea>
        </div>
        <div class="form-group">
            <label for="analysis_date">Date et heure de mise en analyse</label>
            <input type="datetime-local" name="analysis_date" id="analysis_date" class="form-control" value="{{ isset($sampleAnalysis->analysis_date) ? \Carbon\Carbon::parse($sampleAnalysis->analysis_date)->format('Y-m-d\TH:i') : old('analysis_date') }}">
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <h4>Informations sur le produit</h4>
        <div class="form-group">
            <label for="supplier_manufacturer">Fournisseur/Fabricant</label>
            <input type="text" name="supplier_manufacturer" id="supplier_manufacturer" class="form-control" value="{{ $sampleAnalysis->supplier_manufacturer ?? old('supplier_manufacturer') }}">
        </div>
        <div class="form-group">
            <label for="packaging">Conditionnement</label>
            <input type="text" name="packaging" id="packaging" class="form-control" value="{{ $sampleAnalysis->packaging ?? old('packaging') }}">
        </div>
        <div class="form-group">
            <label for="approval_number">Agrément</label>
            <input type="text" name="approval_number" id="approval_number" class="form-control" value="{{ $sampleAnalysis->approval_number ?? old('approval_number') }}">
        </div>
        <div class="form-group">
            <label for="batch_number">Lot</label>
            <input type="text" name="batch_number" id="batch_number" class="form-control" value="{{ $sampleAnalysis->batch_number ?? old('batch_number') }}">
        </div>
        <div class="form-group">
            <label for="fishing_type">Type de pêche</label>
            <input type="text" name="fishing_type" id="fishing_type" class="form-control" value="{{ $sampleAnalysis->fishing_type ?? old('fishing_type') }}">
        </div>
    </div>

    <div class="col-md-6">
        <h4>Informations supplémentaires</h4>
        <div class="form-group">
            <label for="product_name">Nom de produit</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $sampleAnalysis->product_name ?? old('product_name') }}">
        </div>
        <div class="form-group">
            <label for="species">Espèce</label>
            <input type="text" name="species" id="species" class="form-control" value="{{ $sampleAnalysis->species ?? old('species') }}" list="speciesList" autocomplete="off">
            <datalist id="speciesList">
                <option value="Thon rouge">
                <option value="Saumon">
                <option value="Truite">
                <option value="Bar">
                <option value="Daurade">
                <option value="Loup de mer">
                <option value="Sole">
                <option value="Cabillaud">
                <option value="Colin">
                <option value="Merlu">
            </datalist>
        </div>
        <div class="form-group">
            <label for="origin">Origine</label>
            <input type="text" name="origin" id="origin" class="form-control" value="{{ $sampleAnalysis->origin ?? old('origin') }}">
        </div>
        <div class="form-group">
            <label for="packaging_date">Date d'emballage</label>
            <input type="date" name="packaging_date" id="packaging_date" class="form-control" value="{{ $sampleAnalysis->packaging_date ?? old('packaging_date') }}">
        </div>
        <div class="form-group">
            <label for="best_before_date">À consommer jusqu'au</label>
            <input type="date" name="best_before_date" id="best_before_date" class="form-control" value="{{ $sampleAnalysis->best_before_date ?? old('best_before_date') }}">
        </div>
        <div class="form-group">
            <label for="imp">IMP</label>
            <input type="text" name="imp" id="imp" class="form-control" value="{{ $sampleAnalysis->imp ?? old('imp') }}">
        </div>
        <div class="form-group">
            <label for="hx">HX</label>
            <input type="text" name="hx" id="hx" class="form-control" value="{{ $sampleAnalysis->hx ?? old('hx') }}">
        </div>
        <div class="form-group">
            <label for="nucleotide_note">Note Nucléotide</label>
            <textarea name="nucleotide_note" id="nucleotide_note" class="form-control" rows="3">{{ $sampleAnalysis->nucleotide_note ?? old('nucleotide_note') }}</textarea>
        </div>
    </div>
</div>

<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">{{ isset($sampleAnalysis) ? 'Update' : 'Save' }}</button>
    <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">Cancel</a>
</div>

@push('scripts')
<script>
    // Add dynamic species suggestion based on user input
    document.getElementById('species').addEventListener('input', function(e) {
        const input = e.target;
        const list = document.getElementById('speciesList');
        const value = input.value.toLowerCase();
        
        // If you want to fetch suggestions from an API, you can do it here
        // Example:
        // if (value.length > 2) { // Only search after 3 characters
        //     fetch(`/api/species?q=${encodeURIComponent(value)}`)
        //         .then(response => response.json())
        //         .then(species => {
        //             list.innerHTML = '';
        //             species.forEach(item => {
        //                 const option = document.createElement('option');
        //                 option.value = item.name;
        //                 list.appendChild(option);
        //             });
        //         });
        // }
    });
</script>
@endpush
</form>
