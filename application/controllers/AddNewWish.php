<?php

/**
 * Class AddNewWish
 * My wishList home page controller controller class
 */
class AddNewWish extends CI_Controller
{
    public function index()
    {
        // process views
        $this->load->view('templates/header');
        $this->load->view('pages/add_new_wish');
        $this->load->view('templates/footer');
    }
}
