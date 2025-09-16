document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('[data-dropdown]');

    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('[data-dropdown-button]');
        const panel = dropdown.querySelector('[data-dropdown-panel]');

        button.addEventListener('click', () => {
            const isOpen = !panel.classList.contains('hidden');

            // Cierra todos los demás dropdowns antes de abrir el actual
            document.querySelectorAll('[data-dropdown-panel]').forEach(otherPanel => {
                if (otherPanel !== panel && !otherPanel.classList.contains('hidden')) {
                    otherPanel.classList.classList.add('hidden');
                }
            });

            // Alterna la visibilidad del dropdown actual
            panel.classList.toggle('hidden', isOpen);
        });
    });

    // Cierra cualquier dropdown si se hace clic fuera del botón o el panel
    window.addEventListener('click', (event) => {
        dropdowns.forEach(dropdown => {
            const button = dropdown.querySelector('[data-dropdown-button]');
            const panel = dropdown.querySelector('[data-dropdown-panel]');

            if (!button.contains(event.target) && !panel.contains(event.target)) {
                panel.classList.add('hidden');
            }
        });
    });
});
