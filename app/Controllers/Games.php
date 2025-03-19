<?php

namespace App\Controllers;

use App\Models\GamesModel;

class Games extends BaseController
{
	public function index()
	{
		$model = model(GamesModel::class);

		$data = [
			'games_name' => $model->getvideogames(), // Changed from 'games_name' to 'games'
			'title' => 'VideoGameMania',
		];

		return view('templates/header', $data)
			. view('games/index', $data) // Pass $data to the index view
			. view('templates/footer');
}

    public function show(?string $slug = null)
    {
        $model = model(GamesModel::class);

        $data['game_name'] = $model->getvideogames($slug);
    }
}