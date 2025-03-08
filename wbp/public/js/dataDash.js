// dataDash.js (dashboard.php)

function fetchData() {
    fetch('wbp/core/getData.php')
        .then(response => response.json())
        .then(data => {
            console.log(data); // Debugging: Proveri podatke koji stižu

            // Obrada podataka za reakcije (like vs dislike)
            const likes = data.reports.map(item => parseInt(item.total_likes)); // Konvertuj u brojeve
            const dislikes = data.reports.map(item => parseInt(item.total_dislikes)); // Konvertuj u brojeve

            // Pie chart za reakcije
            const reactionChart = document.getElementById('reactionChart');
            const reactionCtx = reactionChart.getContext('2d');
            new Chart(reactionCtx, {
                type: 'pie',
                data: {
                    labels: ['Likes', 'Dislikes'],
                    datasets: [{
                        label: 'Reakcije (Like vs Dislike)',
                        data: [likes.reduce((a, b) => a + b, 0), dislikes.reduce((a, b) => a + b, 0)], // Sumirane vrednosti
                        backgroundColor: ['#FF5733', '#33FF57'],
                        borderColor: ['#FF5733', '#33FF57'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ": " + tooltipItem.raw;
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Pie chart za broj komentara po destinacijama
            const commentCounts = data.comments.map(item => parseInt(item.total_comments)); // Konvertuj u brojeve

            const commentsChart = document.getElementById('comments');
            const commentsCtx = commentsChart.getContext('2d');
            new Chart(commentsCtx, {
                type: 'pie',
                data: {
                    labels: data.comments.map(item => item.naziv),
                    datasets: [{
                        label: 'Komentari po destinaciji',
                        data: commentCounts,  // Koristi pojedinačne vrednosti
                        backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F4FF33', '#FF33A8'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ": " + tooltipItem.raw;
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Pie chart za prosečan rejting destinacija
            const ratings = data.ratings.map(item => parseFloat(item.avg_rating)); // Konvertuj u brojeve

            const ratingChart = document.getElementById('ratingChart');
            const ratingCtx = ratingChart.getContext('2d');
            new Chart(ratingCtx, {
                type: 'pie',
                data: {
                    labels: data.ratings.map(item => item.naziv),
                    datasets: [{
                        label: 'Prosečan rejting destinacija',
                        data: ratings,  // Koristi pojedinačne vrednosti
                        backgroundColor: ['#F4C542', '#A8FF33', '#FF5733', '#33A8FF', '#FF33A8'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ": " + tooltipItem.raw;
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Pie chart za najpopularnije destinacije
            const popularDestinations = data.popular_destinations.map(item => parseInt(item.reaction_count)); // Konvertuj u brojeve

            const popularDestChart = document.getElementById('popularDestChart');
            const popularDestCtx = popularDestChart.getContext('2d');
            new Chart(popularDestCtx, {
                type: 'pie',
                data: {
                    labels: data.popular_destinations.map(item => item.naziv),
                    datasets: [{
                        label: 'Najpopularnije destinacije',
                        data: popularDestinations, // Koristi pojedinačne vrednosti
                        backgroundColor: ['#FF5733', '#3357FF', '#33FF57', '#F4FF33', '#FF33A8'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ": " + tooltipItem.raw;
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Greška pri dohvatanju podataka:', error);
        });
}

// Poziv funkcije pri učitavanju stranice
document.addEventListener('DOMContentLoaded', fetchData);
