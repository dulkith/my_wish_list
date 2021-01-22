<?php

/**
 * Class WishListHome
 * My wishList home page controller controller class
 */
class Edit extends CI_Controller
{
    public function index()
    {
        // process views
        $this->load->view('templates/header');
        $this->load->view('pages/edit_new_wish');
        $this->load->view('templates/footer');
    }
}
