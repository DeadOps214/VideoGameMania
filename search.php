<?php

class Search extends CI_Controller {

    public function index() {
        // Get the search query from the URL
        $query = $this->input->get('query');

        // Perform your search logic here (e.g., querying the database)
        // For demonstration, let's assume we have a model called 'Game_model'
        $this->load->model('GamesModel');
        $data['results'] = $this->GamesModel->search_games($query); // Replace with your actual search logic

        // Prepare data for the view
        $data['title'] = 'Search Results for: ' . esc($query);

        // Load the views
        $this->load->view('templates/header', $data);
        $this->load->view('search/results', $data);
        $this->load->view('templates/footer');
    }
}