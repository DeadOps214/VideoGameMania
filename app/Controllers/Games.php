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
            'title' => '',
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
            . view('games/view', $data) // Pass $data to the view
            . view('templates/footer');
    }

    public function new()
    {
        helper('form');

        return view('templates/header', ['title' => 'Add A New Game'])
            . view('games/create')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        // Retrieve the posted data
        $data = $this->request->getPost(['game_name', 'genre', 'price', 'released_date', 'Image_URL']);

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

        // Retrieve validated data
        $post = $this->validator->getValidated();

        // Format price as a float (optional, but ensures it's stored as a decimal)
        $price = floatval($post['price']);

        // Ensure release date is formatted correctly (it should be in YYYY-MM-DD)
        $released_date = date('Y-m-d', strtotime($post['released_date']));

        // Prepare the data for insertion
        $model = model(GamesModel::class);

        $model->save([
            'game_name'    => $post['game_name'],
            'slug'         => url_title($post['game_name'], '-', true),
            'genre'        => $post['genre'],
            'price'        => $price,  // Store as a decimal
            'released_date' => $released_date,  // Store as a date
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

    public function map()
    {
        return view('games/map');
    }

    public function findStores()
    {
 // Get user's current location from the request
        $latitude = $this->request->getGet('lat');
        $longitude = $this->request->getGet('lng');

        // Define the radius in meters (10 miles)
        $radius = 16093.4; // 10 miles in meters

        // Query OpenStreetMap for game electronics stores
        $query = "[out:json];(node['shop'='video_game'](around:$radius,$latitude,$longitude););out;";
        $overpassUrl = 'https://overpass-api.de/api/interpreter?data=' . urlencode($query);

        // Make the API request
        $response = file_get_contents($overpassUrl);
        $stores = json_decode($response, true);

        // Return the list of stores
        return $this->response->setJSON($stores);
    }
}