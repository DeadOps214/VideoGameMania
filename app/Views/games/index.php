<h2><?= esc($title) ?></h2>

<?php if ($games_name !== []): ?>

    <?php foreach ($games_name as $games_item): ?>

        <h3><?= esc($games_name['title']) ?></h3>

        <div class="main">
            <?= esc($genre['body']) ?>
        </div>
        <p><a href="/Games/<?= esc($geams_name['slug'], 'url') ?>">View article</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No Games</h3>

    <p>Unable to find any games for you.</p>

<?php endif ?>