console.log('Analysis table script loaded');

// Use the data passed from the Blade template
document.addEventListener('DOMContentLoaded', function() {
    if (!window.echantillonsData) {
        console.warn('echantillonsData is not defined');
        window.echantillonsData = [];
    }
    console.log('Echantillons data:', window.echantillonsData);
});