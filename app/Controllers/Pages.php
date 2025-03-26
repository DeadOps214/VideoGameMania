<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;

class Games extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function view(string $page = 'home')
    {
              if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data['game_name'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}