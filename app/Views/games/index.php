<div class="container mt-4">
    <div class="row"> <!-- Start of the Bootstrap row -->
        <?php if (!empty($games_name)): ?> <!-- Check if the array is not empty -->
            <?php foreach ($games_name as $games_item): ?> <!-- Iterate over the array of games -->
                <div class="col-md-4 mb-4"> <!-- Bootstrap column for each game item -->
                    <div class="card"> <!-- Bootstrap card component -->
                        <img src="<?= esc($games_item['Image_URL']) ?>" class="card-img-top" alt="<?= esc($games_item['game_name']) ?>"> <!-- Game image -->
                        <div class="card-body"> <!-- Card body -->
                            <h5 class="card-title"><?= esc($games_item['game_name']) ?></h5> <!-- Game name -->
                            <p class="card-text"><?= esc($games_item['genre']) ?></p> <!-- Game genre -->
                            <a href="https://mi-linux.wlv.ac.uk/~2218466/VideoGameMania/public/games/<?= esc($games_item['slug'], 'url') ?>" class="btn btn-primary">View Article</a> <!-- Link to the game article -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12"> <!-- Full-width column for the no games message -->
                <h3>No Games</h3>
                <p>Unable to find any games for you.</p>
            </div>
        <?php endif; ?>
    </div> <!-- End of the Bootstrap row -->
</div> <!-- End of the Bootstrap container -->