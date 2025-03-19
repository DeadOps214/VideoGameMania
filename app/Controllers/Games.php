<?php

namespace App\Controllers;

use App\Models\GamesModel;

class Games extends BaseController
{
    public function index()
    {
        $model = model(GamesModel::class);

        $data['games_name'] = $model->getvideogames();
    }

    public function show(?string $slug = null)
    {
        $model = model(GamesModel::class);

        $data['game_name'] = $model->getvideogames($slug);
    }
}