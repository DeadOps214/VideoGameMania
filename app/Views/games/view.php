<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($games['game_name']) ?></title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;  /* Stack elements vertically */
            justify-content: flex-start; /* Align items at the top */
            align-items: center; /* Center horizontally */
            min-height: 100vh;
        }
		
        /* Content Styling */
        .content {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .game-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 2em;
            color: #333;
        }

        p {
            font-size: 1.2em;
            margin: 10px 0;
            color: #555;
        }

    </style>
</head>
<body>

        
        <!-- Display the game image -->
        <img src="<?= esc($games['Image_URL']) ?>" alt="Game Image" class="game-image">

        <p><strong>Genre:</strong> <?= esc($games['genre']) ?></p>
        <p><strong>Price:</strong> £<?= esc($games['price']) ?></p>
        <p><strong>Release Date:</strong> <?= esc($games['released_date']) ?></p>
    </div>
</body>
</html>
