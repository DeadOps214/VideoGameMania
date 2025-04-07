<h2>Search Results</h2>
<?php if (!empty($games_name)): ?>
    <ul>
        <?php foreach ($games_name as $game): ?>
            <li><a href="<?= site_url('games/' . $game['slug']) ?>"><?= esc($game['game_name']) ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No results found for "<?= esc($query) ?>"</p>
<?php endif; ?>