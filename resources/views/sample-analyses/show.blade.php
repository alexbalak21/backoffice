@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Sample Analysis Details</h1>
        <div>
            <a href="{{ route('sample-analyses.edit', $sampleAnalysis) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('sample-analyses.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Sampling Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Sampling Date</th>
                            <td>{{ $sampleAnalysis->sampling_date->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>Sampling Location</th>
                            <td>{{ $sampleAnalysis->sampling_location }}</td>
                        </tr>
                    </table>

                    <h4 class="mt-4">Laboratory Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Lab Receipt Date/Time</th>
                            <td>{{ $sampleAnalysis->lab_receipt_datetime->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Receipt Temperature (°C)</th>
                            <td>{{ number_format($sampleAnalysis->receipt_temperature, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Storage Conditions</th>
                            <td>{{ $sampleAnalysis->storage_conditions }}</td>
                        </tr>
                        <tr>
                            <th>Analysis Date</th>
                            <td>{{ $sampleAnalysis->analysis_date->format('Y-m-d') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $sampleAnalysis->product_name }}</td>
                        </tr>
                        <tr>
                            <th>Supplier/Manufacturer</th>
                            <td>{{ $sampleAnalysis->supplier_manufacturer }}</td>
                        </tr>
                        <tr>
                            <th>Packaging</th>
                            <td>{{ $sampleAnalysis->packaging }}</td>
                        </tr>
                        <tr>
                            <th>Approval Number</th>
                            <td>{{ $sampleAnalysis->approval_number }}</td>
                        </tr>
                        <tr>
                            <th>Batch Number</th>
                            <td>{{ $sampleAnalysis->batch_number }}</td>
                        </tr>
                        <tr>
                            <th>Fishing Type</th>
                            <td>{{ $sampleAnalysis->fishing_type }}</td>
                        </tr>
                        <tr>
                            <th>Species</th>
                            <td>{{ $sampleAnalysis->species }}</td>
                        </tr>
                        <tr>
                            <th>Origin</th>
                            <td>{{ $sampleAnalysis->origin }}</td>
                        </tr>
                        <tr>
                            <th>Packaging Date</th>
                            <td>{{ $sampleAnalysis->packaging_date->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>Best Before Date</th>
                            <td>{{ $sampleAnalysis->best_before_date->format('Y-m-d') }}</td>
                        </tr>
                        @if($sampleAnalysis->imp || $sampleAnalysis->hx)
                        <tr>
                            <th>IMP / HX</th>
                            <td>{{ $sampleAnalysis->imp }} / {{ $sampleAnalysis->hx }}</td>
                        </tr>
                        @endif
                        @if($sampleAnalysis->nucleotide_note)
                        <tr>
                            <th>Nucleotide Note</th>
                            <td>{{ $sampleAnalysis->nucleotide_note }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <small class="text-muted">
                    Created: {{ $sampleAnalysis->created_at->format('Y-m-d H:i') }}
                    @if($sampleAnalysis->created_at != $sampleAnalysis->updated_at)
                        | Updated: {{ $sampleAnalysis->updated_at->format('Y-m-d H:i') }}
                    @endif
                </small>
                <form action="{{ route('sample-analyses.destroy', $sampleAnalysis) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
