<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once(APPPATH . '/libraries/jwt/JWTImplement.php');

class MyWishListV1 extends REST_Controller
{
    function __construct()
    {
        // parent class constructor
        parent::__construct();
        $this->jwt = new JWTImplement();

        // api access limitations configuration
        $this->methods['wishListItems_get']['limit'] = 1000;
        $this->methods['wishListItemsAll_get']['limit'] = 1000;
        $this->methods['wishListItems_post']['limit'] = 500;
        $this->methods['wishListItems_put']['limit'] = 500;
        $this->methods['wishListItems_delete']['limit'] = 100;
    }

    /**
     * Get all watch list item end-point
     */
    public function wishListItems_get()
    {
        if ($this->session->userdata('isLogin')) {
            // load all watch list item from database
            $data = $this->WatchListItem->get_watch_list_items();
            // data response validate
            if ($data) {
                // valid response with user data
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                // user data not found
                $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
            }

        } else {
            $this->response('Unauthorized to access the requested resource!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Get watch list item by id end-point
     */
    public function wishListItem_get()
    {
        if ($this->session->userdata('isLogin')) {
            if ($this->get('id')) {
                // get watch list item by id
                $data = $this->WatchListItem->get_watch_list_items($this->get('id'));
                // data response validate
                if ($data) {
                    // valid response with user data
                    $this->response($data, REST_Controller::HTTP_OK);
                } else {
                    // user data not found
                    $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response('Bad Request!', REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response('Unauthorized to access the requested resource!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Get all watch list items by user id end-point
     */
    public function wishListItemsAll_get()
    {
        if ($this->session->userdata('isLogin')) {
            if ($this->get('userId')) {
                // load all watch list item from database
                $data = $this->WatchListItem->get_user_watch_list_items($this->get('userId'));
                // data response validate
                if ($data) {
                    // valid response with user data
                    $this->response($data, REST_Controller::HTTP_OK);
                } else {
                    // user data not found
                    $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response('Bad Request!', REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response('Unauthorized to access the requested resource!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }


    /**
     * Get all watch list public items by user id end-point
     */
    public function wishListItemsAllPublic_get()
    {
        if ($this->get('userId')) {
            // load all watch list item from database
            $data = $this->WatchListItem->get_user_watch_list_items($this->get('userId'));
            // data response validate
            if ($data) {
                // valid response with user data
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                // user data not found
                $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response('Bad Request!', REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get all watch list public items by user id end-point
     */
    public function wishListItemsAllPublicCount_get()
    {
        if ($this->get('userId')) {
            // load all watch list item from database
            $data = $this->WatchListItem->get_user_watch_list_items($this->get('userId'));
            // data response validate
            if ($data) {
                $sendData = array("count"=>count($data));

                // valid response with user data
                $this->response($sendData, REST_Controller::HTTP_OK);
            } else {
                $sendData = array("count"=>0);
                // user data not found
                $this->response($sendData, REST_Controller::HTTP_OK);
            }
        } else {
            $this->response('Bad Request!', REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Login to system by enter email and password
     * Or register in system with user profile details
     */
    public function wishListItem_post()
    {
        header('Content-type: application/json');
//        if ($this->post('token')
//            && $this->tokenValidate($this->post('token'))
//            && $this->session->userdata('login')) {

        if ($this->session->userdata('isLogin')) {
            header('Content-type: application/json');
            // get new wish list input values
            $itemTitle = $this->post('itemTitle');
            $itemDescription = $this->post('itemDescription');
            $webSiteTitle = $this->post('webSiteTitle');
            $webSiteUrl = $this->post('webSiteUrl');
            $itemImageUrl = $this->post('itemImageUrl');
            $price = $this->post('price');
            $quantity = $this->post('quantity');
            $itemPriority = $this->post('itemPriority');
            $userId = $this->post('userId');

            // validate news user request data
            if ($itemTitle && $webSiteTitle && $webSiteUrl && $itemImageUrl && $price && $quantity && $itemPriority && $userId) {
                // validate user data
                $isUserAvailableData = $this->UserModel->get_users($userId);
                if (!$isUserAvailableData) {
                    // if user detail not found
                    log_message('error', 'Invalid user');
                    $this->response('Invalid user, Please check user details', REST_Controller::HTTP_NOT_FOUND);
                    return;
                }
                // validate web site url
                if (filter_var($webSiteUrl, FILTER_VALIDATE_URL) === FALSE) {
                    log_message('info', 'New wish list website url invalid');
                    $this->response('Wish list website url invalid', REST_Controller::HTTP_NOT_FOUND);
                    return;
                }
                // validate image url
                if (filter_var($itemImageUrl, FILTER_VALIDATE_URL) === FALSE) {
                    log_message('info', 'New wish list image url invalid');
                    $this->response('Wish list image url invalid', REST_Controller::HTTP_NOT_FOUND);
                    return;
                }
                // create new wish list item object
                $newWishListItemData = array(
                    'title' => strip_tags($itemTitle),
                    'websiteTitle' => strip_tags($webSiteTitle),
                    'description' => strip_tags($itemDescription),
                    'websiteUrl' => strip_tags($webSiteUrl),
                    'imageUrl' => strip_tags($itemImageUrl),
                    'price' => strip_tags($price),
                    'quantity' => strip_tags($quantity),
                    'priority' => strip_tags($itemPriority),
                    'userId' => strip_tags($userId),
                    'created' => date("Y-m-d H:i:s")
                );
                // save new user data
                $newWishListItemResponse = $this->WatchListItem->add_new_watch_list_item($newWishListItemData);
                if ($newWishListItemResponse) {
                    // new user registration success
                    log_message('info', 'Wish list item update successfully!');
                    $this->response('Wish list item data save successfully!', REST_Controller::HTTP_OK);
                } else {
                    // new user registration error
                    log_message('error', 'Wish list item update error');
                    $this->response('Wish list item update error', REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                // form validation error
                log_message('error', 'Wish list item update detail problem, Please check and try again');
                $this->response('Wish list item detail problem, Please check and try again', REST_Controller::HTTP_NOT_ACCEPTABLE);
            }
        } else {
            $this->response('Unauthorized to access the requested resource!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
//        else {
//            $this->response('Unauthorized to access the requested resource!', REST_Controller::HTTP_UNAUTHORIZED);
//        }

    /**
     * update watch list item
     */
    public function wishListItem_put()
    {
//        if ($this->post('token')
//            && $this->tokenValidate($this->post('token'))
//            && $this->session->userdata('login')) {

        if ($this->session->userdata('isLogin')) {
            if ($this->get('id')) {
                header('Content-type: application/json');
                // get new wish list input values
                $id = $this->get('id');
                $itemTitle = $this->put('itemTitle');
                $itemDescription = $this->put('$itemDescription');
                $webSiteTitle = $this->put('webSiteTitle');
                $webSiteUrl = $this->put('webSiteUrl');
                $itemImageUrl = $this->put('itemImageUrl');
                $price = $this->put('price');
                $quantity = $this->put('quantity');
                $itemPriority = $this->put('itemPriority');
                $userId = $this->put('userId');

                // validate news user request data
                if ($itemTitle && $webSiteTitle && $webSiteUrl && $itemImageUrl && $price && $quantity && $itemPriority && $userId) {
                    // validate data
                    // validate user
                    $isUserAvailableData = $this->UserModel->get_users($userId);
                    if (!$isUserAvailableData) {
                        // if user detail not found
                        log_message('error', 'Invalid user');
                        $this->response('Invalid user, Please check user details', REST_Controller::HTTP_NOT_FOUND);
                        return;
                    }
                    // validate web site url
                    if (filter_var($webSiteUrl, FILTER_VALIDATE_URL) === FALSE) {
                        log_message('info', 'New wish list website url invalid');
                        $this->response('Wish list website url invalid', REST_Controller::HTTP_NOT_FOUND);
                        return;
                    }
                    // validate image url
                    if (filter_var($itemImageUrl, FILTER_VALIDATE_URL) === FALSE) {
                        log_message('info', 'New wish list image url invalid');
                        $this->response('Wish list image url invalid', REST_Controller::HTTP_NOT_FOUND);
                        return;
                    }
                    // create new wish list item object
                    $newWishListItemData = array(
                        'id' => strip_tags($id),
                        'title' => strip_tags($itemTitle),
                        'description' => strip_tags($itemDescription),
                        'websiteTitle' => strip_tags($webSiteTitle),
                        'websiteUrl' => strip_tags($webSiteUrl),
                        'imageUrl' => strip_tags($itemImageUrl),
                        'price' => strip_tags($price),
                        'quantity' => strip_tags($quantity),
                        'priority' => strip_tags($itemPriority),
                        'userId' => strip_tags($userId),
                    );
                    // save new user data
                    $newWishListItemResponse = $this->WatchListItem->update_watch_list_item_details($newWishListItemData);
                    if ($newWishListItemResponse) {
                        // new user registration success
                        log_message('info', 'Wish list item data save successfully!');
                        $this->response('Wishlist item data save successfully!', REST_Controller::HTTP_OK);
                    } else {
                        // new user registration error
                        log_message('error', 'Wish list item error');
                        $this->response('Wish list item error', REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    // form validation error
                    log_message('error', 'Wish list item detail problem, Please check and try again');
                    $this->response('Wish list item detail problem, Please check and try again', REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            } else {
                // invalid action
                log_message('error', 'Wish list item post action not found');
                $this->response(NULL, REST_Controller::HTTP_FORBIDDEN);
            }
        } else {
            $this->response('Unauthorized to access the requested resource!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * delete watch list item
     */
    protected function wishListItem_delete()
    {
        header('Content-type: application/json');

        if ($this->session->userdata('isLogin')) {
            if ($this->get('id')) {
                // validate watch list item
                // get watch list item by id
                $data = $this->WatchListItem->get_watch_list_items($this->get('id'));
                // data response validate
                if (!$data) {
                    // user data not found
                    $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
                }
                // delete watch list item by id
                $data = $this->WatchListItem->delete_watch_list_item_by_id($this->get('id'));
                // data response validate
                if ($data) {
                    // valid response with user data
                    $this->response($data, REST_Controller::HTTP_OK);
                } else {
                    // user data not found
                    $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response('Bad Request!', REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response('Unauthorized to access the requested resource!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    private function tokenValidate($token)
    {
        try {
            $jwtPayload = $this->jwt->decodeAccessToken($token);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

