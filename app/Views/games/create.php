<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="https://mi-linux.wlv.ac.uk/~2218466/VideoGameMania/public/games" method="post">
    <?= csrf_field() ?>

    <label for="title">New Game Name</label>
    <input type="input" name="game_name" value="<?= set_value('game_name') ?>">
    <br>

    <label for="body">Genre</label>
    <textarea name="genre" cols="45" rows="4"><?= set_value('genre') ?></textarea>
    <br>
	
	<label for="body">Price</label>
    <textarea name="price" cols="45" rows="4"><?= set_value('price') ?></textarea>
    <br>
	
	<label for="body">Release Date</label>
    <textarea name="release date" cols="45" rows="4"><?= set_value('release_date') ?></textarea>
    <br>

    <input type="submit" name="submit" value="Create Game Item">
</form>