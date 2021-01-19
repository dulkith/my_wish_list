<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once(APPPATH . '/libraries/jwt/JWTImplement.php');

class MyWishListV1 extends REST_Controller {

    function __construct()
    {
        // parent class constructor
        parent::__construct();

        // api access limitations configuration
        $this->methods['get_all_users']['limit'] = 1000;
        $this->methods['register_user']['limit'] = 500;
        $this->methods['delete_user']['limit'] = 100;
    }

}