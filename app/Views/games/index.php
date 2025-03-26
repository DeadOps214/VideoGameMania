<?php if (!empty($games_name)): ?> <!-- Check if the array is not empty -->

    <?php foreach ($games_name as $games_item): ?> <!-- Iterate over the array of games -->

        <h3><?= esc($games_item['game_name']) ?></h3> <!-- Display the game name -->
        <div class="main">
            <p><img src="<?= esc($games_item['Image_URL']) ?>" alt="<?= esc($games_item['game_name']) ?>"></p> <!-- Display the game image -->
            <?= esc($games_item['genre']) ?> <!-- Display the genre -->
        </div>
        
        <p><a href="https://mi-linux.wlv.ac.uk/~2218466/VideoGameMania/public/VideoGameMania/<?= esc($games_item['slug'], 'url') ?>">View article</a></p> <!-- Link to the game article -->

    <?php endforeach ?>

<?php else: ?>

    <h3>No Games</h3>
    <p>Unable to find any games for you.</p>

<?php endif ?>
