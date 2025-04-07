<?php

namespace App\Controllers;

use App\Models\GamesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Games extends BaseController
{
    public function index()
    {
        $model = model(GamesModel::class);

        
        $data = [
            'games_name' => $model->getvideogames(), 
            'title' => '',
        ];

        return view('templates/header', $data)
            . view('games/index', $data) 
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

        return view('templates/header', ['title' => 'Add  A New Game'])
            . view('games/create')
            . view('templates/footer');
    }
	
	public function create()
	{
		helper('form');

		// Retrieve the posted data
		$data = $this->request->getPost(['game_name', 'genre', 'price', 'release_date', 'Image_URL']);

		// Perform validation
		if (!$this->validate([
			'game_name'    => 'required|max_length[255]|min_length[3]',
			'genre'        => 'required|max_length[5000]|min_length[10]',
			'price'        => 'required|numeric',  // Ensure price is numeric
			'released_date' => 'required|valid_date[Y-m-d]',  // Ensure release date is in YYYY-MM-DD format
			'Image_URL'    => 'required|max_length[1000000]|min_length[3]',
		])) {
			// Validation fails, return form
			return view('templates/header', ['title' => 'Create A Game Item'])
				. view('games/create')
				. view('templates/footer');
		}

		
		$post = $this->validator->getValidated();


		$price = floatval($post['price']);


		
		
		$model = model(GamesModel::class);

		$model->save([
			'game_name'    => $post['game_name'],
			'slug'         => url_title($post['game_name'], '-', true),
			'genre'        => $post['genre'],
			'price'        => $price,  
			'released_date' => $released_date, 
			'Image_URL'    => $post['Image_URL'],
		]);

		return view('templates/header', ['title' => 'Create A Game Item'])
			. view('games/success')
			. view('templates/footer');
}

	
	public function suggest()
	{
		$query = $this->request->getGet('query'); // Get the query from the AJAX request
		$model = new GamesModel(); // Instantiate the model
		$results = $model->getSuggestions($query); // Fetch suggestions based on the query

		// Prepare the results to return game names and slugs
		$suggestions = [];
		foreach ($results as $game) {
			$suggestions[] = [
				'slug' => $game['slug'], // Assuming 'slug' is the unique identifier for the game
				'game_name' => $game['game_name']
			];
    }

		return $this->response->setJSON($suggestions); // Return results as JSON
}
}
	}
}$released_date = date('Y-m-d', strtotime($post['released_date']));
