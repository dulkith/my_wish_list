<?php

/**
 * Class WishListHome
 * My wishList home page controller controller class
 */
class Register extends CI_Controller
{
    public function index()
    {
        // process views
        $this->load->view('templates/header');
        $this->load->view('pages/register');
        $this->load->view('templates/footer');
    }
}
