<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class GameStore extends ResourceController
{
    public function getNearbyStores()
    {
        $lat = $this->request->getGet('lat');
        $lng = $this->request->getGet('lng');

        // Build Overpass QL query
        $query = "[out:json];
        node[\"shop\"=\"video\"](around:1000, $lat, $lng);
        out;";

        // Make request to Overpass API
        $opts = [
            "http" => [
                "method"  => "POST",
                "header"  => "Content-Type: application/x-www-form-urlencoded",
                "content" => $query,
            ]
        ];
        $context = stream_context_create($opts);
        $result = file_get_contents("https://overpass-api.de/api/interpreter", false, $context);
        $data = json_decode($result, true);

        // Transform into a cleaner format for frontend
        $stores = [];
        if (isset($data['elements'])) {
            foreach ($data['elements'] as $element) {
                $stores[] = [
                    'name' => $element['tags']['name'] ?? 'Game Store',
                    'latitude' => $element['lat'],
                    'longitude' => $element['lon'],
                ];
            }
        }

        return $this->response->setJSON($stores);
    }
}
