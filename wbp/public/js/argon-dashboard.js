(function() {
    "use strict"; // Koristimo strict mode za bolju kontrolu grešaka

    // Prvo ćemo implementirati funkciju za toggling sidebar-a
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Funkcija za inicijalizaciju tooltipova
    const tooltipTriggerList = Array.from(document.querySelectorAll('[data-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Funkcija za inicijalizaciju popovera
    const popoverTriggerList = Array.from(document.querySelectorAll('[data-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Funkcija za odgovornost menija u zavisnosti od veličine ekrana
    const navbarToggler = document.getElementById('navbar-toggler');
    const navbarCollapse = document.getElementById('navbar-collapse');
    if (navbarToggler) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
    }

    // Funkcija za inicijalizaciju grafikona
    function initializeCharts() {
        // Dodatne konfiguracije za grafikone
        const ctx = document.getElementById('ratingChart').getContext('2d');
        const ratingChart = new Chart(ctx, {
            type: 'bar', // Tip grafikona
            data: {
                labels: ['Destinacija 1', 'Destinacija 2', 'Destinacija 3'],
                datasets: [{
                    label: 'Rejting',
                    data: [4.5, 3.8, 4.2],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart za najpopularnije destinacije
        const popularDestCtx = document.getElementById('popularDestChart').getContext('2d');
        const popularDestChart = new Chart(popularDestCtx, {
            type: 'pie', // Pie chart
            data: {
                labels: ['Destinacija A', 'Destinacija B', 'Destinacija C'],
                datasets: [{
                    data: [50, 30, 20],
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF'],
                    hoverOffset: 4
                }]
            }
        });
    }

    // Pokretanje funkcije za inicijalizaciju grafikona
    initializeCharts();

    // Funkcija za ažuriranje statistike na Dashboardu (npr. broj korisnika, broj destinacija)
    function updateDashboardStats() {
        // Preuzimanje podataka putem AJAX-a ili fetch-a
        fetch('wbp/core/getData.php') // Podesite URL na pravi API
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalUsers').textContent = data.totalUsers;
                document.getElementById('totalDestinations').textContent = data.totalDestinations;
            })
            .catch(error => console.error('Greška pri učitavanju statistike:', error));
    }

    // Pozivamo funkciju za učitavanje statistike prilikom učitavanja stranice
    updateDashboardStats();

    // Event listener za druge dinamičke funkcionalnosti (npr. dugme za logout)
    const logoutButton = document.getElementById('logout-button');
    if (logoutButton) {
        logoutButton.addEventListener('click', function() {
            // Pozivanje logike za odjavu (npr. preusmeravanje na login stranicu)
            window.location.href = '/logout'; // Podesite pravi URL za logout
        });
    }

})();