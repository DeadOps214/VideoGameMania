<?php if ($games_name !== []): ?>

    <?php foreach ($games_name as $games_item): ?>

        <h3><?= esc($games_item['game_name']) ?></h3>
        <div class="main">
			<p><img src="<?php echo esc($games_item['Image_URL']) ?>" ></p>
            <?= esc($games_item['genre']) ?>
        </div>
	<div class="container-sm">100% wide until small breakpoint</div>
	<div class="container-md">100% wide until medium breakpoint</div>
	<div class="container-lg">100% wide until large breakpoint</div>
	<div class="container-xl">100% wide until extra large breakpoint</div>
	<div class="container-xxl">100% wide until extra extra large breakpoint</div>

    <?php endforeach ?>

<?php else: ?>

    <h3>No Games</h3>

    <p>Unable to find any games for you.</p>

<?php endif ?>