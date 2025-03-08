<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reports</title>
    <link href="wbp/public/css/dashboard.css" rel="stylesheet">
    <link href="wbp/public/css/chart.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="wbp/public/js/dataDash.js"></script>
</head>
<body>
<?php include 'dashTemp/dash-header.php'; ?>

<div class="container">
    <h1>Admin Dashboard</h1>

    <div class="charts-container">
        <!-- Grafikon za reakcije -->
        <div class="chart">
            <h2>Statistika reakcija</h2>
            <canvas id="reactionChart" width="524" height="262"></canvas>
        </div>
        
        <!-- Grafikon za broj komentara po destinaciji -->
        <div class="chart">
            <h2>Broj komentara po destinaciji</h2>
            <canvas id="comments" width="524" height="262"></canvas>
        </div>

        <!-- Novi grafikon za prosečan rejting destinacija -->
        <div class="chart">
            <h2>Prosečan rejting destinacija</h2>
            <canvas id="ratingChart" width="524" height="262"></canvas>
        </div>

        <!-- Novi grafikon za najpopularnije destinacije (kao bar chart) -->
        <div class="chart">
            <h2>Najpopularnije destinacije</h2>
            <canvas id="popularDestChart" width="524" height="262"></canvas>
        </div>
    </div>
</div>

</body>
</html>
