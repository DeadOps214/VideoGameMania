<?php

namespace App\Controllers;

use App\Models\GamesModel;

class Ajax extends BaseController
{
	public function get($slug = null)
	{
		$model = model(GamesModel::class);
		$data = $model->getvideogames($slug);

		print(json_encode($data));
	}
	
}