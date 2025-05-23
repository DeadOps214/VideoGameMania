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

        /* Suggestions container styling */
        #suggestions {
            border: 1px solid #ccc;
            position: absolute;
            background: white;
            z-index: 1000;
            display: none; /* Initially hidden */
            width: calc(100% - 1rem); /* Match the width of the input */
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0; /* Highlight on hover */
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
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('games/new') ?>">Add Games</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('games/map') ?>">Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('games/account') ?>">Account</a>
                </li>
            </ul>
            <form class="d-flex position-relative">
                <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <div id="suggestions"></div> 
            </form>
        </div>
    </div>
</nav>

<h1><?= esc($title) ?></h1>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#search').on('input', function() {
        let query = $(this).val();

        if (query.length > 2) {
            $.ajax({
                url: '<?= base_url('games/suggest') ?>',
                method: 'GET',
                data: { query: query },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let suggestions = '';
                    if (data.length > 0) {
                        data.forEach(function(game) {
                            suggestions += '<div class="suggestion-item" data-url="<?= base_url('games/') ?>' + game.slug + '">' + game.game_name + '</div>'; // Use slug for URL
                        });
                    } else {
                        suggestions = '<div style="padding: 10px;">No results found</div>';
                    }
                    $('#suggestions').html(suggestions).show();
                },
                error: function() {
                    $('#suggestions').html('<div>Error fetching suggestions</div>').show();
                }
            });
        } else {
            $('#suggestions').empty().hide();
        }
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#search').length) {
            $('#suggestions').hide();
        }
    });

    $(document).on('click', '.suggestion-item', function() {
        window.location.href = $(this).data('url'); // Redirect to the game page using the slug
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
