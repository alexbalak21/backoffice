<?php

function generateRapport($client)
{

    $client['name'] = "SCAPMAREE";
    $client['address'] = "5 rue Marcelin Berthelot<br>91320 WISSOUS Cedex";
    $client['recipient'] = "M. Adrien CAGNA";

    ob_start(); ?>

    <head>
        <meta charset="UTF-8">
        <title>Rapport d'Essai</title>
    </head>

    <body>
        <header>
            <img class="logo" src="/img/logo_underline.png" alt="novocib logo">
            <div class="address">
                <strong>NOVOCIB</strong><br>
                Criée Boulogne<br>
                Halle à Marée Quai Jean Voisin<br>
                62200 BOULOGNE-SUR-MER<br>
                Tél : 06 31 44 68 05 / Email : labo@novocib.com<br>
            </div>
            <div class="title">
                <p>
                    <span class="title-text"> Rapport d'essais numéro:</span>
                    <span class="ref">NOVOCIB 210825-2 DOS KBIO NORDVIK</span>
                </p>
                <p>
                    <span class="title-text"> Date d'émission:</span>
                    <span class="date">01/01/2022</span>
                </p>
                <p class="name">
                    Dos de cabillaud
                </p>
            </div>
            <div class="client">
                <span>
                    <strong><?= $client['name']; ?></strong><br>
                    <?= $client['address']; ?>
                    <?php if (!empty($client['recipient'])): ?>
                        <br>A l'attention de <?= $client['recipient']; ?>
                    <?php endif; ?>
                </span>
            </div>
        </header>
        <main>
            <div>
                <span class="features-title">Caractéristiques de l'échantillon</span>
                <table class="features-table" cellpadding="8" cellspacing="0">
                    <tr>
                        <td><strong>Date et lieu de prélèvement</strong></td>
                        <td>COPROMER, 21/08/2023, 11h</td>
                        <td><strong>Conditions de conservation à la réception :</strong></td>
                        <td>0-2°C</td>
                    </tr>
                    <tr>
                        <td><strong>Date, heure et T° à la réception au laboratoire :</strong></td>
                        <td>21/08/2023, 11h20, 0°C</td>
                        <td><strong>Date de mise en analyse :</strong></td>
                        <td>21/08/2023, 16h</td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 16px;">
                <span class="features-title">Identification de l’échantillon (données fournis par le client)</span>
                <table cellspacing="0" cellpadding="6" class="client-table" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;">
                    <tr>
                        <td><strong>Fournisseur/Fabricant :</strong></td>
                        <td>NORDVIK</td>
                        <td><strong>Nom de produit :</strong></td>
                        <td>Dos de cabillaud</td>
                    </tr>
                    <tr>
                        <td><strong>Conditionnement :</strong></td>
                        <td>Vrac</td>
                        <td><strong>Espèce :</strong></td>
                        <td>Gadus morhua</td>
                    </tr>
                    <tr>
                        <td><strong>Agrément :</strong></td>
                        <td>IS A76 EFTA</td>
                        <td><strong>Origine :</strong></td>
                        <td>Iceland</td>
                    </tr>
                    <tr>
                        <td><strong>Lot :</strong></td>
                        <td>E-227</td>
                        <td><strong>Date d'emballage :</strong></td>
                        <td>Non indiqué</td>
                    </tr>
                    <tr>
                        <td><strong>Type de pêche :</strong></td>
                        <td colspan="3">Chalut/lignes</td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 16px;">
                <span class="results-title">Résultats des essais physico-chimiques</span>
                <table class="results-table" cellpadding="6" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N° Éch</th>
                            <th>Lot | Date Fab. | DLC</th>
                            <th>Essai (méthode)</th>
                            <th>Résultat (incertitude)</th>
                            <th>Unité</th>
                            <th>Critère de non-conformité (qualité B)</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>250820-1</td>
                            <td>PRECICE® Nucleotides Assay Kit (NOVOCOB) lot NCN2833L5</td>
                            <td>
                                Méthode enzymatique colorimétrique de dosage de trois nucléotides :<br>
                                IMP, Inosine et Hypoxanthine<br>
                                AFNOR XP V45-077 (2025)
                            </td>
                            <td>
                                IMP 11% (±2%)<br>
                                Hypoxanthine 28% (±2%)
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
            <div class="validation">
                <p class="validation-title">VALIDATION</p>
            </div>
        </main>
    </body>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 1.5rem;
        }

        header {
            position: relative;
        }

        .logo {
            height: 65px;
            width: auto;
        }

        .address {
            position: absolute;
            text-align: center;
            font-size: 12px;
        }

        .title {
            text-align: center;
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
            font-size: 15px;
            top: 160;
            right: 10;
            display: inline-block;
            border: 1px solid #000;
            margin-left: auto;
            padding-left: 0.5rem;
            padding-right: 5rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        main {
            margin-top: 155px;
        }

        .features-title {
            background-color: #b3c6e7;
            display: inline-block;
            padding: 4px 8px;
            margin-bottom: 6px;
        }

        table {
            font-size: 12px;
        }

        .features-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            border: #000 1px solid;
        }

        .features-table td {
            border: #000 1px solid;
        }

        .client-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            border: #000 1px solid;
        }

        .client-table td {
            border: #000 1px solid;
        }

        .results-title {
            background-color: #b3c6e7;
            display: inline-block;
            padding: 4px 8px;
            margin-bottom: 6px;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            border: #000 1px solid;
        }

        .results-table td,
        th {
            border: #000 1px solid;
        }

        .validation-title {
            font-weight: bold;
            margin-top: 12px;
        }

        .validation {
            margin-top: 30px;
            padding-left: 1rem;
            background-color: lightgray;

        }
    </style>

<?php return ob_get_clean();
}
