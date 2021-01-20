<?php

/**
 * Class WatchListItem
 * My wishlist! system watch list item model class
 */
class WatchListItem extends CI_Model
{
    public function __construct()
    {
    }

    // get all watch list items or watch list item detail/s by id
    public function get_watch_list_items($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('wish_list_items');
            return $query->result_array();
        }

        $query = $this->db->get_where('wish_list_items', array('id' => $id));
        return $query->row_array();
    }

    // get all watch list items by user id
    public function get_user_watch_list_items($userId)
    {
        $query = $this->db->get_where('wish_list_items', array('userId' => $userId));
        return $query->result_array();
    }

    // add new watch list item
    public function add_new_watch_list_item($newWatchListItem)
    {
        // save watch list item details into db
        $result = $this->db->insert('wish_list_items', $newWatchListItem);
        // return the query status(id)
        return $result ? $this->db->insert_id() : false;
    }

    // update watch list item details
    public function update_watch_list_item_details($updateWatchListItem)
    {
        // save updated watch list item details into db
        $result = $this->db->replace('wish_list_items', $updateWatchListItem);
        // return the update query status
        return $result ? $result : false;
    }

    public function delete_watch_list_item_by_id($id)
    {
        // save updated watch list item details into db
        $result = $this->db->delete('wish_list_items', array('id' => $id));
        // return the update query status
        return $result ? $result : false;

    }
}
