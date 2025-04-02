<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoGameMania</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<style>
	.custom-card {
    height: 500px; /* Set a fixed height for the card */
    width: 100%; /* Ensure the card takes full width of the column */
}

.card-img-top {
    height: 350px; /* Set a fixed height for the image */
    object-fit: cover; /* Ensure the image covers the area without distortion */
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('games'); ?>">VideoGameMania</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url ('games/new') ?>">Add Games</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url ('games/new') ?>">Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url ('games/new') ?>">Account</a>
                </li>
            </ul>
            <!-- Search Form -->
            <form class="d-flex" action="<?php echo site_url('search'); ?>" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

    <h1><?= esc($title) ?></h1>