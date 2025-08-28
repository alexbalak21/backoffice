<x-layout>
    @vite(['resources/css/analysis-table.css'])
    <div class="container-fluid">
        <table id="editableTable" class="analysis-table">
      <thead>
        <tr>
          <th>Date, Heure</th>
          <th>Lieu de prélèvement</th>
          <th>Date, heure</th>
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
        <tr>
          <td contenteditable="true" data-label="Date Heure prélèvement"></td>
          <td contenteditable="true" data-label="Lieu de prélèvement"></td>
          <td contenteditable="true" data-label="Date Heure réception"></td>
          <td contenteditable="true" data-label="T° à la réception"></td>
          <td contenteditable="true" data-label="Conditions de conservation"></td>
          <td contenteditable="true" data-label="Date de mise en analyse"></td>
          <td contenteditable="true" data-label="Fournisseur / Fabricant"></td>
          <td contenteditable="true" data-label="Conditionnement"></td>
          <td contenteditable="true" data-label="Agrément"></td>
          <td contenteditable="true" data-label="Lot"></td>
          <td contenteditable="true" data-label="Type de pêche"></td>
          <td contenteditable="true" data-label="Nom de produit"></td>
          <td contenteditable="true" data-label="Espèce"></td>
          <td contenteditable="true" data-label="Origine"></td>
          <td contenteditable="true" data-label="Date d'emballage"></td>
          <td contenteditable="true" data-label="À consommer jusqu'au"></td>
          <td contenteditable="true" data-label="IMP"></td>
          <td contenteditable="true" data-label="HX"></td>
          <td contenteditable="true" data-label="Note Nucléotide"></td>
        </tr>
      </tbody>
    </table>
    </div>
</x-layout>