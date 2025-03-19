<?php if ($games_name !== []): ?>

    <?php foreach ($games_name as $games_item): ?>

        <h3><?= esc($games_item['game_name']) ?></h3>

        <div class="main">
            <?= esc($games_item['genre']) ?>
        </div>


    <?php endforeach ?>

<?php else: ?>

    <h3>No Games</h3>

    <p>Unable to find any games for you.</p>

<?php endif ?>