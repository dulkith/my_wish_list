<?php

/**
 * Class WishListHome
 * My wishList home page controller controller class
 */
class PublicLink extends CI_Controller
{
    public function index()
    {
        // process views
        $this->load->view('templates/header');
        $this->load->view('pages/home_public');
        $this->load->view('templates/footer');
    }
}
