function fetchData() {
    fetch('wbp/core/getData.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Greška pri dohvatanju podataka: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Za debugovanje, proverite šta se tačno vraća

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


// Kombinovanje broja komentara i reakcija za svaku destinaciju
const combinedData = data.popular_destinations.map((dest) => {
    const commentsForDest = data.comments.find(comment => comment.naziv === dest.naziv);
    const totalComments = commentsForDest ? parseInt(commentsForDest.total_comments) : 0;
    const totalReactions = parseInt(dest.reaction_count);

    return {
        naziv: dest.naziv,
        totalEngagement: totalComments + totalReactions, // Kombinovani broj angažmana
        totalComments: totalComments,
        totalReactions: totalReactions
    };
});

// Sortiranje destinacija po ukupnom angažmanu
combinedData.sort((a, b) => b.totalEngagement - a.totalEngagement);

// Prikazivanje podataka u tabeli ili grafikonu
const popularDestLabels = combinedData.map(item => item.naziv);
const engagementCounts = combinedData.map(item => item.totalEngagement);

const popularDestChart = document.getElementById('popularDestChart');
const popularDestCtx = popularDestChart.getContext('2d');
new Chart(popularDestCtx, {
    type: 'bar',
    data: {
        labels: popularDestLabels,
        datasets: [{
            label: 'Ukupno angažovanje (Reakcije + Komentari)',
            data: engagementCounts,
            backgroundColor: '#F4C542',
            borderColor: '#F4A400',
            borderWidth: 1
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


        })
        .catch(error => {
            console.error('Greška pri učitavanju podataka:', error);
        });
}

// Poziv funkcije za podatake prilikom učitavanja stranice
window.onload = fetchData;