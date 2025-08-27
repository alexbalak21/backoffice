<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analysis Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; }
        .section { margin-bottom: 15px; }
        .section h2 { font-size: 16px; border-bottom: 1px solid #000; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th { background-color: #f2f2f2; text-align: left; padding: 8px; }
        td { padding: 8px; border: 1px solid #ddd; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Analysis Report</h1>
        <p>Generated on: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <h2>Sample Information</h2>
        <table>
            <tr>
                <th>Client</th>
                <td>{{ $analysis->client ?? 'N/A' }}</td>
                <th>Product Name</th>
                <td>{{ $analysis->product_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Batch Number</th>
                <td>{{ $analysis->batch_number ?? 'N/A' }}</td>
                <th>Sampling Date</th>
                <td>{{ $analysis->sampling_date ? $analysis->sampling_date->format('d/m/Y') : 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Analysis Details</h2>
        <table>
            <tr>
                <th>Analysis Date</th>
                <td>{{ $analysis->analysis_date ? $analysis->analysis_date->format('d/m/Y') : 'N/A' }}</td>
                <th>Species</th>
                <td>{{ $analysis->species ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Origin</th>
                <td>{{ $analysis->origin ?? 'N/A' }}</td>
                <th>Supplier/Manufacturer</th>
                <td>{{ $analysis->supplier_manufacturer ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    @if(!empty($analysis->nucleotide_note))
    <div class="section">
        <h2>Notes</h2>
        <p>{{ $analysis->nucleotide_note }}</p>
    </div>
    @endif

    <div class="footer">
        <p>This is a computer-generated document. No signature is required.</p>
    </div>
</body>
</html>
