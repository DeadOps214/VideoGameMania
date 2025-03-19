<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;

class Games extends BaseController
{
	public function index()
		{
			$model = model(GamesModel::class);
	
			$data = [
				'games_name' => $model->getvideogames(),
				'game_id'     => 'Games archive',
			];

			return view('templates/header', $data)
				. view('games/index')
				. view('templates/footer');
		}
    public function view(string $page = 'home')
    {
              if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}