<div class="container mt-4">
    <h2><?= esc($title) ?></h2>
    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-0 justify-content-center ">
        <?php if (!empty($games_name)): ?>
            <?php foreach ($games_name as $games_item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card custom-card"> <!-- Add a custom class for styling -->
                        <img src="<?= esc($games_item['Image_URL']) ?>" class="card-img-top" alt="<?= esc($games_item['game_name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($games_item['game_name']) ?></h5>
                            <p class="card-text"><?= esc($games_item['genre']) ?></p>
                            <a href="https://mi-linux.wlv.ac.uk/~2218466/VideoGameMania/public/games/<?= esc($games_item['slug'], 'url') ?>" class="btn btn-primary">View Article</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <h3>No Games</h3>
                <p>Unable to find any games for you.</p>
            </div>
        <?php endif; ?>
    </div>
</div>