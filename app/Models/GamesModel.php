<?php

namespace App\Models;

use CodeIgniter\Model;

class GamesModel extends Model
{
    protected $table = 'videogames';
    protected $allowedFields = ['game_name', 'slug', 'genre', 'released_date', 'Image_URL', 'price'];

    public function getvideogames($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    // New method to search for games
    public function searchGames($query)
    {
        return $this->like('game_name', $query)->findAll(); // Search for games by name
    }

    // New method to get suggestions
    public function getSuggestions($query)
    {
        return $this->like('game_name', $query)->findAll(); // Fetch games that match the query
    }
}

