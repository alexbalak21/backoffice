<x-layout>
    @vite(['resources/css/analysis-table.css'])
    @vite(['resources/js/analysis-table.js'])
    
    <div class="container-fluid">
        <div id="saveStatus" class="mt-2"></div>
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
            <td data-label="actions">
                <div class="dropdown">
                    <a class="dropdown-toggle text-secondary user-select-none" id="row-{{ $echantillon->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
                    <ul class="dropdown-menu" id="dropdownMenu{{ $echantillon->id }}" aria-labelledby="row-{{ $echantillon->id }}">
                        <li><a class="dropdown-item" onclick="makeEditableForUpdate({{ $echantillon->id }})"><i class="fa-solid fa-pen"></i> Modifier</a></li>
                        <li><a class="dropdown-item delete-btn" href="#" data-id="{{ $echantillon->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </a></li>
                    </ul>
                </div>
            </td>
            <td data-label="nom_client">{{ $echantillon->nom_client }}</td>
              <td data-label="date_heure_prelevement">{{ $echantillon->date_heure_prelevement }}</td>
              <td data-label="lieu_de_prelevement">{{ $echantillon->lieu_de_prelevement }}</td>
              <td data-label="date_heure_reception">{{ $echantillon->date_heure_reception }}</td>
              <td data-label="temperature_reception">{{ $echantillon->temperature_reception }}</td>
              <td data-label="conditions_conservation">{{ $echantillon->conditions_conservation }}</td>
              <td data-label="date_mise_en_analyse">{{ $echantillon->date_mise_en_analyse }}</td>
              <td data-label="fournisseur_fabricant">{{ $echantillon->fournisseur_fabricant }}</td>
              <td data-label="conditionnement">{{ $echantillon->conditionnement }}</td>
              <td data-label="agrement">{{ $echantillon->agrement }}</td>
              <td data-label="lot">{{ $echantillon->lot }}</td>
              <td data-label="type_de_peche">{{ $echantillon->type_de_peche }}</td>
              <td data-label="nom_de_produit">{{ $echantillon->nom_de_produit }}</td>
              <td data-label="espece">{{ $echantillon->espece }}</td>
              <td data-label="origine">{{ $echantillon->origine }}</td>
              <td data-label="date_emballage">{{ $echantillon->date_emballage }}</td>
              <td data-label="a_consommer_jusqu_au">{{ $echantillon->a_consommer_jusqu_au }}</td>
              <td data-label="imp">{{ $echantillon->imp }}</td>
              <td data-label="hx">{{ $echantillon->hx }}</td>
              <td data-label="note_nucleotide">{{ $echantillon->note_nucleotide }}</td>
          </tr>
      @endforeach
      </tbody>
            </table>
        </div>
   
        <div class="text-end">
            <button id="newRowToggleBtn" type="button" class="btn btn-sm btn-success" onclick="toggleNewRow()"><i class="fa-solid fa-plus"></i> Ligne</button>
        </div>
        <div class="mb-4">
            <button type="submit" id="saveBtn" onclick="saveData()" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Enregistrer
            </button>
        </div>
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
    </script>


    <script>
      function saveData() {
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
          
          // Send data to the server
          fetch('/echantillon-analyses', {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  'Accept': 'application/json',
                  'Content-Type': 'application/json',
                  'X-Requested-With': 'XMLHttpRequest'
              },
              body: JSON.stringify({ analyses: data })
          })
          .then(response => response.json())
          .then(data => {
              const statusDiv = document.getElementById('saveStatus');
              if (data.success) {
                const newRow = document.querySelector('#editableTable tbody tr[data-id="new"]');
                newRow.querySelectorAll('td').forEach(td => td.removeAttribute('contenteditable'));
                const dropdown = createDropdown(data.data[0].id);
                newRow.querySelectorAll('td').forEach((td, index) => {
                 td.textContent = data.data[0][td.getAttribute('data-label')]
                 newRow.setAttribute('data-id', data.data[0].id);
                });
                newRow.querySelector('td:first-child').appendChild(dropdown);

                createToast('Données enregistrées avec succès', 'success');
              } else {
                  throw new Error(data.message || 'Erreur lors de l\'enregistrement');
              }
          })
          .catch(error => {
              const statusDiv = document.getElementById('saveStatus');
              statusDiv.textContent = 'Erreur: ' + error.message;
              statusDiv.className = 'alert alert-danger mt-2';
          });
      }

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
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
                  createToast('Échantillon supprimé avec succès', 'success'); 
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

    function createToast(message, type = 'success') {
                  const toastEl = document.createElement('div');
                  toastEl.className = `toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3`;
                  toastEl.setAttribute('role', 'alert');
                  toastEl.innerHTML = `
                      <div class="d-flex">
                          <div class="toast-body">
                              ${message}
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

    function toggleNewRow() {
        const newRow = document.querySelector('tr[data-id="new"]');
        const toggleBtn = document.getElementById('newRowToggleBtn');
        if (newRow) {
            // Check if any cell has content
            const hasData = Array.from(newRow.querySelectorAll('td')).some(td => {
                return td.textContent && td.textContent.trim() !== '';
            });
            
            if (hasData) {
                if (!confirm('Êtes-vous sûr de vouloir annuler la création de cette ligne ? Les données non enregistrées seront perdues.')) {
                    return; // Don't remove the row if user cancels
                }
            }
            
            newRow.remove();
            toggleBtn.classList.remove('btn-danger');
            toggleBtn.classList.add('btn-success');
            toggleBtn.innerHTML = '<i class="fa-solid fa-plus"></i> Ligne';
        } else {
            const tableBody = document.querySelector('#editableTable tbody');
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-id', 'new');
            newRow.innerHTML = `
            <td contenteditable="true" data-label="actions"></td>
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
            `;
            tableBody.appendChild(newRow);
            toggleBtn.classList.remove('btn-success');
            toggleBtn.classList.add('btn-danger');
            toggleBtn.innerHTML = '<i class="fa-solid fa-trash"></i> Ligne';
        }
    }

    function createDropdown(id) {
        const dropdown = document.createElement('div')
        dropdown.classList.add('dropdown')
        dropdown.innerHTML = `
                    <a class="dropdown-toggle text-secondary user-select-none" id="row-${id}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
                    <ul class="dropdown-menu" id="dropdownMenu${id}" aria-labelledby="row-${id}">
                        <li><a class="dropdown-item" onclick="makeEditableForUpdate(${id})"><i class="fa-solid fa-pen"></i> Modifier</a></li>
                        <li><a class="dropdown-item delete-btn" href="#" data-id="${id}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </a></li>
                    </ul>
        `
        return dropdown;
    }

    function makeEditableForUpdate(id) {
        console.log('Making row editable with ID:', id);
        const row = document.querySelector(`tr[data-id="${id}"]`);
        row.style.backgroundColor = '#C0C0C0';
        if (!row) {
            console.error('Row not found with ID:', id);
            return;
        }
        const cells = row.querySelectorAll('td');
        cells.forEach(cell => {
            if (cell.getAttribute('data-label') !== 'actions') cell.setAttribute('contenteditable', 'true');
        });

        // Update actions cell
        const actionsCell = row.querySelector('td[data-label="actions"]');
        if (actionsCell) {
            actionsCell.innerHTML = '';
            actionsCell.appendChild(saveDiscardButtons(id));
        }
    }

    function updateRow(id) {
        console.log('Updating row with ID:', id);
        const row = document.querySelector(`tr[data-id="${id}"]`);
        if (!row) {
            console.error('Row not found with id:', id);
            return;
        }
        
        // Get all cells that should be editable
        const cells = row.querySelectorAll('td[contenteditable="true"]');
        actionsCell = row.querySelector('td[data-label="actions"]');
        
        const data = {};
        let hasValidData = false;
        actionsCell.innerHTML = ''
        actionsCell.appendChild(createDropdown(id));
        cells.forEach(cell => {
            const field = cell.getAttribute('data-label');
            const value = cell.textContent.trim();
            console.log(`Field: ${field}, Value:`, value);
            
            // Only add to data if we have both field and value
            if (field) {
                data[field] = value;
                hasValidData = true;
                // Remove visual feedback
                cell.style.border = '';
                cell.style.borderRadius = '';
                cell.style.padding = '';
                cell.removeAttribute('contenteditable');
                document.querySelector(`tr[data-id="${id}"]`).style.backgroundColor = '';
            }
        });
        
        console.log('Data to be sent:', data);
        
        if (!hasValidData) {
            console.error('No valid data to update');
            alert('Veuillez entrer des données valides avant de sauvegarder');
            return;
        }
        
        fetch(`/echantillon-analyses/${id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors de la mise à jour');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                createToast('Échantillon mis à jour avec succès', 'success'); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la mise à jour');
        });
    }


    function saveDiscardButtons(id) {
        const btnGroup = document.createElement('div');
        btnGroup.classList.add('btn-group', 'btn-group-sm');
        
        // Create save button
        const saveBtn = document.createElement('button');
        saveBtn.className = 'btn btn-success';
        saveBtn.innerHTML = '<i class="fa-solid fa-save"></i>';
        saveBtn.title = 'Enregistrer les modifications';
        saveBtn.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            updateRow(id);
        };
        
        // Create cancel button
        const cancelBtn = document.createElement('button');
        cancelBtn.className = 'btn btn-secondary';
        cancelBtn.innerHTML = '<i class="fa-solid fa-times"></i>';
        cancelBtn.title = 'Annuler';
        cancelBtn.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.reload(); // Simple way to reset the row for now
        };
        
        btnGroup.appendChild(saveBtn);
        btnGroup.appendChild(cancelBtn);
        
        return btnGroup;
    }

    
</script>
</x-layout>
