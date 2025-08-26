@if(isset($sampleAnalysis))
    {!! Form::model($sampleAnalysis, ['route' => ['sample-analyses.update', $sampleAnalysis], 'method' => 'PUT']) !!}
@else
    {!! Form::open(['route' => 'sample-analyses.store']) !!}
@endif

<div class="row">
    <div class="col-md-6">
        <h4>Sampling Information</h4>
        <div class="form-group">
            {{ Form::label('sampling_date', 'Sampling Date') }}
            {{ Form::date('sampling_date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('sampling_location', 'Sampling Location') }}
            {{ Form::text('sampling_location', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>

    <div class="col-md-6">
        <h4>Laboratory Information</h4>
        <div class="form-group">
            {{ Form::label('lab_receipt_datetime', 'Lab Receipt Date/Time') }}
            {{ Form::datetimeLocal('lab_receipt_datetime', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('receipt_temperature', 'Receipt Temperature (°C)') }}
            {{ Form::number('receipt_temperature', null, ['class' => 'form-control', 'step' => '0.01', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('storage_conditions', 'Storage Conditions') }}
            {{ Form::textarea('storage_conditions', null, ['class' => 'form-control', 'rows' => 2, 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('analysis_date', 'Analysis Date') }}
            {{ Form::date('analysis_date', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <h4>Product Information</h4>
        <div class="form-group">
            {{ Form::label('supplier_manufacturer', 'Supplier/Manufacturer') }}
            {{ Form::text('supplier_manufacturer', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('packaging', 'Packaging') }}
            {{ Form::text('packaging', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('approval_number', 'Approval Number') }}
            {{ Form::text('approval_number', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('batch_number', 'Batch Number') }}
            {{ Form::text('batch_number', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('fishing_type', 'Fishing Type') }}
            {{ Form::text('fishing_type', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>

    <div class="col-md-6">
        <h4>Additional Information</h4>
        <div class="form-group">
            {{ Form::label('product_name', 'Product Name') }}
            {{ Form::text('product_name', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('species', 'Species') }}
            {{ Form::text('species', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('origin', 'Origin') }}
            {{ Form::text('origin', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('packaging_date', 'Packaging Date') }}
            {{ Form::date('packaging_date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('best_before_date', 'Best Before Date') }}
            {{ Form::date('best_before_date', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('imp', 'IMP') }}
            {{ Form::text('imp', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('hx', 'HX') }}
            {{ Form::text('hx', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('nucleotide_note', 'Nucleotide Note') }}
            {{ Form::textarea('nucleotide_note', null, ['class' => 'form-control', 'rows' => 3]) }}
        </div>
    </div>
</div>

<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">
        {{ isset($sampleAnalysis) ? 'Update' : 'Create' }} Analysis
    </button>
    <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">Cancel</a>
</div>

{!! Form::close() !!}
