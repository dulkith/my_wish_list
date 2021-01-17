<?php

/**
 * Class WishListHome
 * My wishList home page controller controller class
 */
class WishListHome extends CI_Controller
{
    public function index()
    {
        // process views
        $this->load->view('templates/header');
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
    }
}
