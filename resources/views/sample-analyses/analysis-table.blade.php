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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveBtn = document.getElementById('saveBtn');
            const statusDiv = document.getElementById('saveStatus');
            
            saveBtn.addEventListener('click', async function() {
                const rows = document.querySelectorAll('#editableTable tbody tr');
                const data = [];
                
                rows.forEach(row => {
                    const cells = row.querySelectorAll('td[contenteditable="true"]');
                    const rowData = {};
                    let isEmpty = true;
                    
                    cells.forEach(cell => {
                        const field = cell.dataset.label.toLowerCase()
                            .replace(/ /g, '_')
                            .replace(/[éèê]/g, 'e')
                            .replace(/[àâ]/g, 'a')
                            .replace(/[ùû]/g, 'u')
                            .replace(/[îï]/g, 'i')
                            .replace(/[ôö]/g, 'o')
                            .replace(/[ç]/g, 'c')
                            .replace(/[^a-z_]/g, '');
                        
                        const value = cell.textContent.trim();
                        if (value) {
                            rowData[field] = value;
                            isEmpty = false;
                        }
                    });
                    
                    if (!isEmpty) {
                        data.push(rowData);
                    }
                });
                
                if (data.length === 0) {
                    showStatus('Aucune donnée à enregistrer', 'warning');
                    return;
                }
                
                try {
                    saveBtn.disabled = true;
                    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enregistrement...';
                    statusDiv.innerHTML = '';
                    
                    const response = await fetch('/api/echantillon-analyses', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });
                    
                    const result = await response.json();
                    
                    if (response.ok) {
                        const successMsg = `${result.created_count} enregistrement(s) créé(s) avec succès`;
                        showStatus(successMsg, 'success');
                        
                        // Clear the table after successful save
                        if (result.created_count > 0) {
                            setTimeout(() => {
                                document.querySelectorAll('#editableTable tbody tr').forEach(row => {
                                    row.querySelectorAll('td[contenteditable="true"]').forEach(cell => {
                                        cell.textContent = '';
                                    });
                                });
                            }, 1500);
                        }
                    } else {
                        const errorMsg = result.message || 'Erreur lors de l\'enregistrement';
                        showStatus(errorMsg, 'danger');
                        
                        if (result.errors) {
                            result.errors.forEach(error => {
                                showStatus(`Ligne ${error.index + 1}: ${error.message}`, 'danger');
                            });
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showStatus('Une erreur est survenue: ' + error.message, 'danger');
                } finally {
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<i class="fas fa-save me-2"></i>Enregistrer';
                }
            });
            
            function showStatus(message, type = 'info') {
                const alert = document.createElement('div');
                alert.className = `alert alert-${type} alert-dismissible fade show`;
                alert.role = 'alert';
                alert.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                statusDiv.appendChild(alert);
                
                // Auto-dismiss after 5 seconds
                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 150);
                }, 5000);
            }
        });
    </script>
    @endpush
</x-layout>