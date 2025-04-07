<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="https://mi-linux.wlv.ac.uk/~2218466/VideoGameMania/public/games" method="post" class="form-container">
    <?= csrf_field() ?>
    
    <div class="form-group">
        <label for="game_name">New Game Name</label>
        <input type="text" name="game_name" value="<?= set_value('game_name') ?>" id="game_name" class="form-control" placeholder="Enter Game Name">
    </div>

    <div class="form-group">
        <label for="genre">Genre</label>
        <textarea name="genre" id="genre" cols="45" rows="4" class="form-control" placeholder="Enter Genre"><?= set_value('genre') ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <textarea name="price" id="price" cols="45" rows="4" class="form-control" placeholder="Enter Price"><?= set_value('price') ?></textarea>
    </div>

    <div class="form-group">
        <label for="release_date">Release Date</label>
        <textarea name="released_date" id="released_date" cols="45" rows="4" class="form-control" placeholder="Enter Release Date"><?= set_value('released_date') ?></textarea>
    </div>

    <div class="form-group">
        <label for="Image_URL">Image URL</label>
        <input type="text" name="Image_URL" id="Image_URL" value="<?= set_value('Image_URL') ?>" class="form-control" placeholder="Enter Image Link" required>
    </div>

    <div class="form-group">
        <input type="submit" name="submit" value="Create Game Item" class="btn btn-primary">
    </div>
</form>

<style>
    /* Center form on the page */
    .form-container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Styling form labels */
    .form-group label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
    }

    /* Input and textarea styling */
    .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #5b9bd5;
        outline: none;
        box-shadow: 0 0 8px rgba(91, 155, 213, 0.5);
    }

    /* Submit button */
    .btn {
        background-color: #5b9bd5;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #4178a1;
    }

    .btn:focus {
        outline: none;
    }
</style>
