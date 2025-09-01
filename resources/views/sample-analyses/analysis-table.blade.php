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
        <div class="table-container">
            <table id="editableTable" class="analysis-table">
      <thead>
        <tr>
          <th><i class="fa-solid fa-gear"></i></th>
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
          <tr data-id="{{ $echantillon->id }}">
            <td>
                <div class="dropdown">
                    <a class="dropdown-toggle text-secondary user-select-none" id="row-{{ $echantillon->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
                    <ul class="dropdown-menu" id="dropdownMenu{{ $echantillon->id }}" aria-labelledby="row-{{ $echantillon->id }}">
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen"></i> Modifier</a></li>
                        <li><a class="dropdown-item delete-btn" href="#" data-id="{{ $echantillon->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </a></li>
                    </ul>
                </div>
            </td>
            <td>{{ $echantillon->nom_client }}</td>
              <td>{{ $echantillon->date_heure_prelevement }}</td>
              <td>{{ $echantillon->lieu_de_prelevement }}</td>
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
        <tr class="data-row" data-id="new">
          <td></td>
          <td contenteditable="true" data-label="nom_client"></td>
          <td contenteditable="true" data-label="date_heure_prelevement"></td>
          <td contenteditable="true" data-label="lieu_de_prelevement"></td>
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
        </form>

    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet échantillon ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
                </div>
            </div>
        </div>
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
                const newRow = document.querySelector('#editableTable tbody tr[data-id="new"]');
                // REMOUVE contenteditable="true" from each td
                newRow.querySelectorAll('td').forEach(td => td.removeAttribute('contenteditable'));
                console.log(data.data[0]);
                newRow.querySelectorAll('td').forEach((td, index) => {
                //FOREACH  OF data-label TD AND SET TEXT CONTENT FROM DATA
                 td.textContent = data.data[0][td.getAttribute('data-label')]
                 newRow.setAttribute('data-id', data.data[0].id);
                });

                  // Show toast notification
                  const toastEl = document.getElementById('notificationToast');
                  const toastBody = toastEl.querySelector('.toast-body');
                  const toast = new bootstrap.Toast(toastEl);
                  
                  toastBody.textContent = 'Données enregistrées avec succès!';
                  toast.show();
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

      // Handle delete confirmation
      let echantillonIdToDelete = null;
      
      // Set the echantillon ID when delete button is clicked
      document.addEventListener('click', function(e) {
          if (e.target.closest('.delete-btn')) {
              e.preventDefault();
              echantillonIdToDelete = e.target.closest('.delete-btn').getAttribute('data-id');
          }
      });

      // Handle the actual deletion
      document.getElementById('confirmDelete').addEventListener('click', function() {
          if (!echantillonIdToDelete) return;
          
          fetch(`/echantillon-analyses/${echantillonIdToDelete}`, {
              method: 'DELETE',
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              }
          })
          .then(response => {
              if (!response.ok) throw new Error('Erreur lors de la suppression');
              return response.json();
          })
          .then(data => {
              if (data.success) {
                  // Remove the row from the table
                  const row = document.querySelector(`tr[data-id="${echantillonIdToDelete}"]`);
                  if (row) row.remove();
                  
                  // Show success message
                  const toastEl = document.createElement('div');
                  toastEl.className = 'toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3';
                  toastEl.setAttribute('role', 'alert');
                  toastEl.innerHTML = `
                      <div class="d-flex">
                          <div class="toast-body">
                              Échantillon supprimé avec succès
                          </div>
                          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                  `;
                  document.body.appendChild(toastEl);
                  const toast = new bootstrap.Toast(toastEl);
                  toast.show();
                  
                  // Remove the toast after it hides
                  toastEl.addEventListener('hidden.bs.toast', function() {
                      toastEl.remove();
                  });
              }
          })
          .catch(error => {
              console.error('Error:', error);
              alert('Une erreur est survenue lors de la suppression');
          })
          .finally(() => {
              // Close the modal
              const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
              modal.hide();
              echantillonIdToDelete = null;
          });
      });
    </script>
</x-layout>