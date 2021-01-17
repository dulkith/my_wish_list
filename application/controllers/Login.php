<?php

/**
 * Class WishListHome
 * My wishList home page controller controller class
 */
class Login extends CI_Controller
{
    public function index()
    {
        // process views
        $this->load->view('templates/header');
        $this->load->view('pages/login');
        $this->load->view('templates/footer');
    }
}
