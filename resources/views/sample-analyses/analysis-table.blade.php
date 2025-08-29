<x-layout>
    @vite(['resources/css/analysis-table.css', 'resources/js/analysis-table.js'])
    <div class="container-fluid">
        <div class="mb-4">
            <button id="saveBtn" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Enregistrer
            </button>
            <div id="saveStatus" class="mt-2"></div>
        </div>
        <table id="editableTable" class="analysis-table">
      <thead>
        <tr>
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
        <tr class="data-row">
          <td contenteditable="true" data-label="Date Heure prélèvement"></td>
          <td contenteditable="true" data-label="date_heure_prelevement"></td>
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
      </tbody>
    </table>
    </div>
    <div class="mt-4">
        @if($echantillons->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            @foreach($echantillons->first()->getAttributes() as $key => $value)
                                <th>{{ $key }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($echantillons as $echantillon)
                            <tr>
                                @foreach($echantillon->getAttributes() as $value)
                                    <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">Aucun échantillon trouvé.</div>
        @endif
    </div>

    @push('scripts')
    <script>
      console.log("Test");
      
        // Make the data available to JavaScript
        window.echantillonsData = {!! $echantillonsJson !!};
        
        // Now you can use the data in your JavaScript files
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Echantillons data:', window.echantillonsData);
            
            // Example: Access the data
            // window.echantillonsData.forEach(function(echantillon) {
            //     console.log(echantillon);
            // });
        });
    </script>
    @endpush
</x-layout>