<?php

namespace App\Controllers;

use App\Models\GamesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Games extends BaseController
{
    public function index()
    {
        $model = model(GamesModel::class);

        // Use 'games_name' to reflect that it contains multiple games
        $data = [
            'games_name' => $model->getvideogames(), // This should be an array of games
            'title' => 'VideoGameMania',
        ];

        return view('templates/header', $data)
            . view('games/index', $data) // Pass $data to the index view
            . view('templates/footer');
    }

    public function show(?string $slug = null)
    {
        $model = model(GamesModel::class);

        $data = [
		'games' => $model->getvideogames($slug),
		'title' => 'Game Information',
		];
		

        if ($data['games'] === null) {
            throw new PageNotFoundException('Cannot find the games item: ' . $slug);
        }

        $data['game_name'] = $data['games']['game_name'];

        return view('templates/header', $data)
            . view('games/view')
            . view('templates/footer');
    }
}