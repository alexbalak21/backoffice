// Handle analysis table functionality
document.addEventListener('DOMContentLoaded', async function() {
    // First, fetch and log the data from the API
    try {
        const response = await fetch('http://localhost:8000/api/echantillon-analyses', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(`HTTP error! status: ${response.status}`, { cause: errorData });
        }
        const data = await response.json();
        console.log('Fetched data from API:', data);
    } catch (error) {
        console.error('Error fetching data from API:', error);
        if (error.cause) {
            console.error('Error details:', error.cause);
        }
    }

    const saveBtn = document.getElementById('saveBtn');
    if (!saveBtn) return;

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
                
                let value = cell.textContent.trim();
                
                // Format date fields to dd/MM/yy HH:mm if they contain a date
                const dateTimeFields = ['date_heure_prelevement', 'date_heure_reception', 'date_mise_en_analyse'];
                if (dateTimeFields.includes(field) && value) {
                    try {
                        const [datePart, timePart = '00:00'] = value.split(' ');
                        const [day, month, year] = datePart.split('/');
                        
                        if (day && month && year) {
                            // Handle both 2-digit and 4-digit years
                            const formattedYear = year.length === 4 ? year.slice(-2) : year;
                            // Format as dd/MM/yy HH:mm
                            const formattedDate = `${day.padStart(2, '0')}/${month.padStart(2, '0')}/${formattedYear}`;
                            value = `${formattedDate} ${timePart}`;
                            
                            // Create date object for validation
                            const date = new Date();
                            const fullYear = year.length === 2 ? 2000 + parseInt(year) : parseInt(year);
                            date.setFullYear(fullYear, parseInt(month) - 1, parseInt(day));
                            
                            if (isNaN(date.getTime())) {
                                throw new Error('Invalid date');
                            }
                            
                            // Format the time part if it exists
                            if (timePart) {
                                const [hours, minutes = '00'] = timePart.split(':');
                                value = `${formattedDate} ${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}`;
                            }
                        } else {
                            // Fallback to default date parsing
                            const date = new Date(value);
                            if (!isNaN(date.getTime())) {
                                const day = String(date.getDate()).padStart(2, '0');
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const year = String(date.getFullYear()).slice(-2);
                                const hours = String(date.getHours()).padStart(2, '0');
                                const minutes = String(date.getMinutes()).padStart(2, '0');
                                value = `${day}/${month}/${year} ${hours}:${minutes}`;
                            }
                        }
                    } catch (e) {
                        console.warn(`Could not format date for ${field}:`, value);
                    }
                }
                
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
            
            // Log the data being sent to the server
            console.log('Data being sent to server:');
            console.log(JSON.stringify(data, null, 2));
            
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
