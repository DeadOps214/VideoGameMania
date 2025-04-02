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
	
	    public function new()
    {
        helper('form');

        return view('templates/header', ['title' => 'Create A Games Item'])
            . view('games/create')
            . view('templates/footer');
    }
	
	    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['game_name', 'genre', 'price', 'release_date']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'game_name' => 'required|max_length[255]|min_length[3]',
            'genre'  => 'required|max_length[5000]|min_length[10]',
			'price'  => 'required|max_length[5000]|min_length[3]',
			'release_date'  => 'required|max_length[10]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(GamesModel::class);

        $model->save([
            'game_name' => $post['game_name'],
            'slug'  => url_title($post['game_name'], '-', true),
            'genre'  => $post['genre'],
			'price'  => $post['price'],
			'release_date'  => $post['release_date'],
        ]);

        return view('templates/header', ['title' => 'Create A Games Item'])
            . view('games/success')
            . view('templates/footer');
    }
}