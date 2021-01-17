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
        $this->load->view('pages/addNewWish');
        $this->load->view('templates/footer');
    }
}
