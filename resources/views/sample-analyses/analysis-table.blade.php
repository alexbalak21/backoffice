<x-layout>
    @vite(['resources/css/analysis-table.css'])
    @vite(['resources/js/analysis-table.js'])
    <div class="container-fluid">
        <form id="analysisForm" action="{{ route('echantillon-analyses.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <button type="submit" id="saveBtn" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Enregistrer
                </button>
                <div id="saveStatus" class="mt-2"></div>
            </div>
        <table id="editableTable" class="analysis-table">
      <thead>
        <tr>
          <th>Client</th>
          <th>Date Heure prélèvement</th>
          <th>Lieu de prélèvement</th>
          <th>Date Heure</th>
          <th>T° à la réception</th>
          <th>Conditions de conservation</th>
          <th>Date de mise en analyse</th>
          <th>Fournisseur / Fabricant</th>
          <th>Conditionnement</th>
          <th>Agrément</th>
          <th>Lot</th>
          <th>Type de pêche</th>
          <th>Nom de produit</th>
          <th>Espèce</th>
          <th>Origine</th>
          <th>Date d'emballage</th>
          <th>À consommer jusqu'au</th>
          <th>IMP</th>
          <th>HX</th>
          <th>Note Nucléotide</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($echantillons as $echantillon)
          <tr>

              <td>{{ $echantillon->date_heure_prelevement }}</td>
              <td>{{ $echantillon->lieu_prelevement }}</td>
              <td>{{ $echantillon->date_heure_reception }}</td>
              <td>{{ $echantillon->temperature_reception }}</td>
              <td>{{ $echantillon->conditions_conservation }}</td>
              <td>{{ $echantillon->date_mise_en_analyse }}</td>
              <td>{{ $echantillon->fournisseur_fabricant }}</td>
              <td>{{ $echantillon->conditionnement }}</td>
              <td>{{ $echantillon->agrement }}</td>
              <td>{{ $echantillon->lot }}</td>
              <td>{{ $echantillon->type_de_peche }}</td>
              <td>{{ $echantillon->nom_de_produit }}</td>
              <td>{{ $echantillon->espece }}</td>
              <td>{{ $echantillon->origine }}</td>
              <td>{{ $echantillon->date_emballage }}</td>
              <td>{{ $echantillon->a_consommer_jusqu_au }}</td>
              <td>{{ $echantillon->imp }}</td>
              <td>{{ $echantillon->hx }}</td>
              <td>{{ $echantillon->note_nucleotide }}</td>
          </tr>
      @endforeach
        <tr class="data-row">
          <td contenteditable="true" data-label="nom_client"></td>
          <td contenteditable="true" data-label="date_heure_prelevement"></td>
          <td contenteditable="true" data-label="lieu_prelevement"></td>
          <td contenteditable="true" data-label="date_heure_reception"></td>
          <td contenteditable="true" data-label="temperature_reception"></td>
          <td contenteditable="true" data-label="conditions_conservation"></td>
          <td contenteditable="true" data-label="date_mise_en_analyse"></td>
          <td contenteditable="true" data-label="fournisseur_fabricant"></td>
          <td contenteditable="true" data-label="conditionnement"></td>
          <td contenteditable="true" data-label="agrement"></td>
          <td contenteditable="true" data-label="lot"></td>
          <td contenteditable="true" data-label="type_de_peche"></td>
          <td contenteditable="true" data-label="nom_de_produit"></td>
          <td contenteditable="true" data-label="espece"></td>
          <td contenteditable="true" data-label="origine"></td>
          <td contenteditable="true" data-label="date_emballage"></td>
          <td contenteditable="true" data-label="a_consommer_jusqu_au"></td>
          <td contenteditable="true" data-label="imp"></td>
          <td contenteditable="true" data-label="hx"></td>
          <td contenteditable="true" data-label="note_nucleotide"></td>
        </tr>

        @php
          $columns = [
        'nom_client',
        'date_heure_prelevement',
        'lieu_de_prelevement',
        'date_heure_reception',
        'temperature_reception',
        'conditions_conservation',
        'date_mise_en_analyse',
        'fournisseur_fabricant',
        'conditionnement',
        'agrement',
        'lot',
        'type_de_peche',
        'nom_de_produit',
        'espece',
        'origine',
        'date_emballage',
        'a_consommer_jusqu_au',
        'imp',
        'hx',
        'note_nucleotide',
        'rapport_genere',
        'ref_rapport'
    
    ];
        @endphp
      </tbody>
    </table>
        </form>
    </div>
    <script>
      window.echantillonsData = {!! $echantillonsJson ?? '[]' !!};

      // Add form submission handler to collect all table data
      document.getElementById('analysisForm').addEventListener('submit', function(e) {
          e.preventDefault();
          
          const formData = new FormData();
          const rows = document.querySelectorAll('#editableTable tbody tr');
          const data = [];
          
          rows.forEach((row, rowIndex) => {
              const rowData = {};
              const cells = row.querySelectorAll('td[contenteditable="true"]');
              
              cells.forEach(cell => {
                  const field = cell.getAttribute('data-label');
                  if (field) {
                      rowData[field] = cell.textContent.trim();
                  }
              });
              
              if (Object.keys(rowData).length > 0) {
                  data.push(rowData);
              }
          });
          
          // Add the data to the form
          formData.append('analyses', JSON.stringify(data));
          
          // Submit the form
          fetch(this.action, {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({ analyses: data })
          })
          .then(response => response.json())
          .then(data => {
              const statusDiv = document.getElementById('saveStatus');
              if (data.success) {
                  statusDiv.textContent = 'Données enregistrées avec succès!';
                  statusDiv.className = 'alert alert-success mt-2';
              } else {
                  throw new Error(data.message || 'Erreur lors de l\'enregistrement');
              }
          })
          .catch(error => {
              const statusDiv = document.getElementById('saveStatus');
              statusDiv.textContent = 'Erreur: ' + error.message;
              statusDiv.className = 'alert alert-danger mt-2';
          });
      });
    </script>
</x-layout>