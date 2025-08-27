<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rapport d'Essai - {{ $analysis->product_name ?? 'Analyse' }}</title>
</head>
<body>
    <div class="header">
        @php
            $logoPath = base_path('public/img/logo_underline.png');
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoMime = mime_content_type($logoPath);
        @endphp
        <img class="logo" src="data:{{ $logoMime }};base64,{{ $logoData }}" alt="novocib logo">
        <div class="address">
            <strong>NOVOCIB</strong><br>
            Criée Boulogne<br>
            Halle à Marée Quai Jean Voisin<br>
            62200 BOULOGNE-SUR-MER<br>
            Tél : 06 31 44 68 05 / Email : labo@novocib.com
        </div>
        <div class="client">
            <strong><?= e($analysis->client) ?></strong><br>
            À l'attention de <?= e($analysis->client) ?>
        </div>
        <div class="title">
            <h1>Rapport d'Essai</h1>
            <p>Référence: NOVOCIB-{{ $analysis->id }}-{{ date('Ymd') }}</p>
            <p>Date d'analyse: {{ $analysis->analysis_date ? \Carbon\Carbon::parse($analysis->analysis_date)->format('d/m/Y') : 'N/A' }}</p>
            <p>Date d'émission: {{ now()->format('d/m/Y') }}</p>
            <p class="name">{{ $analysis->product_name ?? 'Analyse d\'échantillon' }}</p>
        </div>
    </div>
    <main>
        <div class="section">
            <h2>Caractéristiques de l'échantillon</h2>
            <table>
                <tr>
                    <th>Date et lieu de prélèvement</th>
                    <td>{{ $analysis->sampling_location ?? 'Non spécifié' }}, {{ $analysis->sampling_date ? \Carbon\Carbon::parse($analysis->sampling_date)->format('d/m/Y') : 'N/A' }}</td>
                    <th>Conditions de conservation</th>
                    <td>{{ $analysis->storage_conditions ?? 'Non spécifié' }}</td>
                </tr>
                <tr>
                    <th>Réception au laboratoire</th>
                    <td>
                        {{ $analysis->lab_receipt_datetime ? \Carbon\Carbon::parse($analysis->lab_receipt_datetime)->format('d/m/Y H:i') : 'N/A' }}
                        {{ $analysis->receipt_temperature ? ', ' . number_format($analysis->receipt_temperature, 1) . '°C' : '' }}
                    </td>
                    <th>Date de mise en analyse</th>
                    <td>{{ $analysis->analysis_date ? \Carbon\Carbon::parse($analysis->analysis_date)->format('d/m/Y') : 'N/A' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>Identification de l'échantillon</h2>
            <table>
                <tr>
                    <th>Fournisseur/Fabricant</th>
                    <td><?= e($analysis->supplier_manufacturer) ?: 'Non spécifié' ?></td>
                    <th>Nom de produit</th>
                    <td><?= e($analysis->product_name) ?: 'Non spécifié' ?></td>
                </tr>
                <tr>
                    <th>Conditionnement</th>
                    <td><?= e($analysis->packaging) ?: 'Non spécifié' ?></td>
                    <th>Espèce</th>
                    <td><?= e($analysis->species) ?: 'Non spécifié' ?></td>
                </tr>
                <tr>
                    <th>Agrément</th>
                    <td><?= e($analysis->approval_number) ?: 'Non spécifié' ?></td>
                    <th>Origine</th>
                    <td><?= e($analysis->origin) ?: 'Non spécifié' ?></td>
                </tr>
                <tr>
                    <th>N° de lot</th>
                    <td><?= e($analysis->batch_number) ?: 'Non spécifié' ?></td>
                    <th>Date d'emballage</th>
                    <td><?= $packagingDate ?></td>
                </tr>
                <tr>
                    <th>Type de pêche</th>
                    <td colspan="3"><?= e($analysis->fishing_type) ?: 'Non spécifié' ?></td>
                </tr>
                <?php if ($analysis->best_before_date): ?>
                <tr>
                    <th>Date limite de consommation</th>
                    <td colspan="3"><?= $bestBeforeDate ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>

        <?php if (!empty($nucleotideNotes) || !empty($analysis->imp) || !empty($analysis->hx)): ?>
        <div class="section">
            <h2>Résultats des essais physico-chimiques</h2>
            <table>
                <thead>
                    <tr>
                            <th>N° Éch</th>
                            <th>Lot | Date Fab. | DLC</th>
                            <th>Essai (méthode)</th>
                            <th>Résultat (incertitude)</th>
                            <th>Unité</th>
                            <th>Critères de qualité</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                            <td>NOVOCIB-{{ $analysis->id }}</td>
                            <td>
                                {{ $analysis->batch_number ?? 'N/A' }}<br>
                                @if($analysis->packaging_date)
                                    Fab: {{ \Carbon\Carbon::parse($analysis->packaging_date)->format('d/m/Y') }}
                                @endif
                                @if($analysis->best_before_date)
                                    <br>DLC: {{ \Carbon\Carbon::parse($analysis->best_before_date)->format('d/m/Y') }}
                                @endif
                            </td>
                            <td>
                                Méthode enzymatique colorimétrique de dosage des nucléotides :<br>
                                IMP, Inosine et Hypoxanthine<br>
                                AFNOR XP V45-077 (2025)
                            </td>
                            <td>
                                @if($analysis->imp)
                                    IMP {{ number_format($analysis->imp, 1) }}% (±2%)<br>
                                @endif
                                @if($analysis->hx)
                                    Hypoxanthine {{ number_format($analysis->hx, 1) }}% (±2%)<br>
                                @endif
                                @if($analysis->nucleotide_notes)
                                    {!! nl2br(e($analysis->nucleotide_notes)) !!}
                                @endif
                            </td>
                        <td>Molar %</td>
                        <td>
                            IMP &gt; 9%<br>
                            Hypoxanthine &lt; 40%
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <div class="footer">
            <p>Document généré le {{ now()->format('d/m/Y H:i') }} - NOVOCIB-{{ $analysis->id }}-{{ date('Ymd') }}</p>
        </div>
    </main>
        <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 0;
            padding: 0;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
            position: relative;
        }
        .header h1 { 
            margin: 0; 
            font-size: 24px; 
        }
        .header p { 
            margin: 5px 0; 
        }
        .section { 
            margin-bottom: 15px; 
        }
        .section h2 { 
            font-size: 16px; 
            border-bottom: 1px solid #000; 
            padding-bottom: 5px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 15px;
            border: 1px solid #000;
        }
        th { 
            background-color: #f2f2f2; 
            text-align: left; 
            padding: 8px; 
            border: 1px solid #000;
        }
        td { 
            padding: 8px; 
            border: 1px solid #000; 
        }
        .footer { 
            text-align: center; 
            margin-top: 30px; 
            font-size: 10px; 
            color: #666; 
        }
        .logo { 
            height: 65px;
            width: auto;
            margin-bottom: 20px; 
        }
        .address { 
            margin-bottom: 20px; 
            text-align: center; 
            font-size: 12px;
        }
        .title { 
            text-align: center; 
            margin: 20px 0;
            font-size: 14px;
        }
        .ref {
            color: #3771C8;
            font-weight: bold;
        }
        .name {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .client {
            position: absolute;
            top: 20px;
            right: 20px;
            text-align: left;
            border: 1px solid #000;
            padding: 10px;
            font-size: 12px;
        }
        .features-title, .results-title {
            background-color: #b3c6e7; 
            display: inline-block; 
            padding: 4px 8px; 
            margin: 20px 0 10px 0;
            font-weight: bold;
        }
        .validation {
            margin-top: 30px;
            text-align: right;
        }
        .validation-title {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</body>
</html>