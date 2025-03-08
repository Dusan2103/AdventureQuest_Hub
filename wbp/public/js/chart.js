async function fetchData() {
    const response = await fetch('wbp/core/getData.php');
    const data = await response.json();
    console.log(data);  // Proveri strukturu podataka
    return data;
}

// Funkcija za inicijalizaciju svih grafikona
async function initializeCharts() {
    const data = await fetchData();

    // Grafikon za reakcije (likes/dislikes)
    const labels = data.reports.map(item => item.naziv);
    const likes = data.reports.map(item => item.total_likes);
    const dislikes = data.reports.map(item => item.total_dislikes);

    const reactionChart = document.getElementById('reactionChart');
    const reactionCtx = reactionChart.getContext('2d');
    new Chart(reactionCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Like',
                data: likes,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Dislike',
                data: dislikes,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // Grafikon za broj komentara po destinaciji
    const commentLabels = data.comments.map(item => item.naziv);
    const commentCounts = data.comments.map(item => item.total_comments);

    const commentsChart = document.getElementById('comments');
    const commentsCtx = commentsChart.getContext('2d');
    new Chart(commentsCtx, {
        type: 'bar',
        data: {
            labels: commentLabels,
            datasets: [{
                label: 'Komentari po destinaciji',
                data: commentCounts,
                backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F4FF33', '#FF33A8'],
                hoverOffset: 4
            }]
        }
    });

    // Grafikon za prosečan rejting destinacija
    const ratingLabels = data.ratings.map(item => item.naziv);
    const ratings = data.ratings.map(item => item.avg_rating);

    const ratingChart = document.getElementById('ratingChart');
    const ratingCtx = ratingChart.getContext('2d');
    new Chart(ratingCtx, {
        type: 'line',
        data: {
            labels: ratingLabels,
            datasets: [{
                label: 'Prosečan rejting',
                data: ratings,
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                fill: true,
                borderWidth: 2
            }]
        }
    });

    // Grafikon za najpopularnije destinacije
    const popularDestLabels = data.popular_destinations.map(item => item.naziv);
    const visitCounts = data.popular_destinations.map(item => item.reaction_count); // Ili visit_count, zavisi šta koristiš

    const popularDestChart = document.getElementById('popularDestChart');
    const popularDestCtx = popularDestChart.getContext('2d');
    new Chart(popularDestCtx, {
        type: 'bar',
        data: {
            labels: popularDestLabels,
            datasets: [{
                label: 'Broj poseta',
                data: visitCounts,
                backgroundColor: '#F4C542',
                borderColor: '#F4A400',
                borderWidth: 1
            }]
        }
    });

    // Kreiranje pie grafikona za svaku destinaciju
    data.reactions.forEach((dest, index) => {
        // Kreiranje canvas elementa za svaku destinaciju
        const canvasId = `destinationChart${index}`;
        const container = document.getElementById('destinationCharts');
        const canvas = document.createElement('canvas');
        canvas.id = canvasId;
        container.appendChild(canvas);

        const ctxDest = document.getElementById(canvasId).getContext('2d');
        new Chart(ctxDest, {
            type: 'bar',
            data: {
                labels: ['Lajkovi', 'Dislajkovi'],
                datasets: [{
                    label: dest.naziv,
                    data: [dest.total_likes, dest.total_dislikes],
                    backgroundColor: ['#4CAF50', '#F44336'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    });

    // Bar chart za upoređivanje lajkova i dislajkova za sve destinacije
    const ctxCompare = document.getElementById('compareChart').getContext('2d');
    new Chart(ctxCompare, {
        type: 'bar',
        data: {
            labels: data.reactions.map(dest => dest.naziv),
            datasets: [{
                label: 'Lajkovi',
                data: data.reactions.map(dest => dest.total_likes),
                backgroundColor: '#4CAF50',
            }, {
                label: 'Dislajkovi',
                data: data.reactions.map(dest => dest.total_dislikes),
                backgroundColor: '#F44336',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });
}

// Pozivanje funkcije za inicijalizaciju grafikona
initializeCharts();
