<?php

/**
 * Class UserModel
 * My wishlist! system user model class
 */
class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // get all users or user detail/s by id
    public function get_users($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('users');
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    // register new user details
    public function add_new_user($newUser)
    {
        // save user details into db
        $result = $this->db->insert('users', $newUser);
        // return the query status(id)
        return $result ? $this->db->insert_id() : false;
    }

    // update user details
    public function update_user_details($updateUser)
    {
        // save updated user details into db
        $result = $this->db->replace('users', $updateUser);
        // return the update query status
        return $result ? $result : false;
    }

    // check user email already exit
    public function use_already_exit($email)
    {
        // filter user by email address
        $query = $this->db->get_where('users', array('email' => $email));
        // check user already exit
        return $query->row();
    }

}
