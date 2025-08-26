const toggleBtn = document.getElementById('toggle-btn');
const sidebar = document.querySelector('aside');

toggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('expand');

    // Close all submenus when collapsing
    if (!sidebar.classList.contains('expand')) {
        const submenus = document.querySelectorAll('.collapse'); // or use a more specific selector
        submenus.forEach(submenu => {
            const instance = bootstrap.Collapse.getInstance(submenu);
            if (instance) {
                instance.hide();
            }
        });
    }
});
