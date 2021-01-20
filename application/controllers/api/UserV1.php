<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once(APPPATH . '/libraries/jwt/JWTImplement.php');

/*
 * My wish list application user controller end-points
 */

class UserV1 extends REST_Controller
{

    function __construct()
    {
        // parent class constructor
        parent::__construct();
        $this->jwt = new JWTImplement();

        // api access limitations configuration
        $this->methods['users_get']['limit'] = 1000;
        $this->methods['users_post']['limit'] = 500;
        $this->methods['user_put']['limit'] = 500;
        $this->methods['users_delete']['limit'] = 100;
        $this->methods['usersLogout_get']['limit'] = 100;
    }

    /**
     * Get all users end-point
     */
    public function users_get()
    {
        // load all users from database
        $data = $this->UserModel->get_users();
        // data response validate
        if ($data) {
            // valid response with user data
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            // user data not found
            $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /**
     * Login to system by enter email and password
     * Or register in system with user profile details
     */
    public function users_post()
    {
        if ($this->get('userAction') == 'register') {
            header('Content-type: application/json');
            // get user input values
            $fname = $this->post('firstName');
            $lname = $this->post('lastName');
            $email = $this->post('email');
            $password = $this->post('password');
            $mobile = $this->post('mobile');

            // validate news user request data
            if ($fname && $lname && $email && $password && $mobile) {
                // validate user info
                $isUserAvailable = $this->UserModel->use_already_exit($email);

                if ($isUserAvailable) {
                    // if user email already exist invalid registration
                    log_message('error', 'User email address already exist');
                    $this->response('User email address already exist', REST_Controller::HTTP_NOT_ACCEPTABLE);
                    return;
                }
                $salt = ('dukamywithslist@25492304kfdsfiit@.lk');
                // hashed user password
                $passwordHashed = md5($salt . $password);
                // create new user object
                $newUserData = array(
                    'fname' => strip_tags($fname),
                    'lname' => strip_tags($lname),
                    'email' => strip_tags($email),
                    'password' => strip_tags($passwordHashed),
                    'mobile' => strip_tags($mobile),
                    'created' => date("Y-m-d H:i:s")
                );
                // save new user data
                $newUserSaveResponse = $this->UserModel->add_new_user($newUserData);
                if ($newUserSaveResponse) {
                    // new user registration success
                    log_message('info', 'Usr register successfully!');
                    $this->response('Usr register successfully!', REST_Controller::HTTP_OK);
                } else {
                    // new user registration error
                    log_message('error', 'User registration error');
                    $this->response('User registration error', REST_Controller::HTTP_BAD_REQUEST);
                }

            } else {
                // form validation error
                log_message('error', 'User registration detail problem, please check and try again');
                $this->response('User registration detail problem, please check and try again', REST_Controller::HTTP_NOT_ACCEPTABLE);
            }

            // user login
        } else if ($this->get('userAction') == 'login') {
            header('Content-type: application/json');
            // validate request data
            if (!$this->post('email') || !$this->post('password')) {
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $email = $this->post('email');
                $password = $this->post('password');
                // validate user login request data
                if ($email && $password) {
                    // validate user info
                    $isUserAvailableData = $this->UserModel->use_already_exit($email);
                    if (!$isUserAvailableData) {
                        // if user detail not found
                        log_message('error', 'User detail not found');
                        $this->response('User detail not found', REST_Controller::HTTP_NOT_FOUND);
                        return;
                    } else {
                        // user login password validation
                        $salt = ('dukamywithslist@25492304kfdsfiit@.lk');
                        // hashed user password
                        $passwordHashed = md5($salt . $password);
                        if ($isUserAvailableData->password == $passwordHashed) {

                            // create login session
                            $loginSessionData = array(
                                'id' => $isUserAvailableData->id,
                                'fname' => $isUserAvailableData->fname,
                                'lname' => $isUserAvailableData->lname,
                                'email' => $isUserAvailableData->email,
                                'mobile' => $isUserAvailableData->mobile,
                                'isLogin' => TRUE
                            );
                            // create access token payload
                            $tokenData['id'] = $isUserAvailableData->id;
                            $tokenData['fname'] = $isUserAvailableData->fname;
                            $tokenData['lname'] = $isUserAvailableData->lname;
                            $tokenData['email'] = $isUserAvailableData->email;
                            $tokenData['mobile'] = $isUserAvailableData->mobile;
                            $token = $this->jwt->newAccessToken($tokenData);
                            $response = array("user" => $isUserAvailableData, "token" => $token);
                            $this->session->set_userdata($loginSessionData);
                            // user login response
                            $this->response($response, REST_Controller::HTTP_OK);
                        } else {
                            log_message('error', 'Login failed, Wrong password');
                            $this->response('Login failed, Wrong password', REST_Controller::HTTP_UNAUTHORIZED);
                        }
                    }
                } else {
                    // form validation error
                    log_message('error', 'User login detail problem, Please check and try again');
                    $this->response('User login detail problem, Please check and try again', REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            }
        } else {
            // invalid action
            log_message('error', 'User post action not found');
            $this->response(NULL, REST_Controller::HTTP_FORBIDDEN);
        }
    }

    public function usersLogout_get(){
        // process views
        $this->session->sess_destroy();
    }
}