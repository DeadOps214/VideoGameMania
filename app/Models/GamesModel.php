<?php

namespace App\Models;

use CodeIgniter\Model;

class GamesModel extends Model
{
    protected $table = 'videogames';

    public function getvideogames($slug = false) // Remove the semicolon here
    {
        if ($slug === false) 
        {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}