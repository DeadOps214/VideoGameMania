<?php

namespace App\Models;

use CodeIgniter\Model;

class GamesModel extends Model
{
    protected $table = 'videogames';
	protected $allowedFields = ['game_name', 'slug', 'genre'];

    public function getvideogames($slug = false)
    {
        if ($slug === false) 
        {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}