<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Insert a new user into the database
     *
     * @param array $data User information (name, phone, email, password)
     * @return bool
     */
    public function insert_user($data) {
        // CodeIgniter Query Builder handles escaping variables to prevent SQL injection
        return $this->db->insert('users', $data);
    }

    /**
     * Retrieve a user by email address
     *
     * @param string $email User's email
     * @return array|null User record or null if not found
     */
    public function get_user_by_email($email) {
        $query = $this->db->get_where('users', array('email' => $email), 1);
        return $query->row_array();
    }

    /**
     * Retrieve a user by their user ID
     *
     * @param int $id User ID
     * @return array|null User record or null if not found
     */
    public function get_user_by_id($id) {
        $query = $this->db->get_where('users', array('id' => $id), 1);
        return $query->row_array();
    }

    /**
     * Retrieve all family members (including Self) for a user
     *
     * @param int $user_id User ID
     * @return array
     */
    public function get_members($user_id) {
        $this->db->order_by("CASE WHEN relation = 'Self' THEN 0 ELSE 1 END", "ASC", FALSE);
        $this->db->order_by("created_at", "ASC");
        $query = $this->db->get_where('family_members', array('user_id' => $user_id));
        return $query->result_array();
    }

    /**
     * Retrieve a specific member details by relation
     *
     * @param int $user_id User ID
     * @param string $relation Relationship
     * @return array|null
     */
    public function get_member_by_relation($user_id, $relation) {
        $query = $this->db->get_where('family_members', array('user_id' => $user_id, 'relation' => $relation), 1);
        return $query->row_array();
    }

    /**
     * Retrieve a specific family member by ID and User ID (for security)
     *
     * @param int $member_id Member ID
     * @param int $user_id User ID
     * @return array|null
     */
    public function get_member_by_id($member_id, $user_id) {
        $query = $this->db->get_where('family_members', array('id' => $member_id, 'user_id' => $user_id), 1);
        return $query->row_array();
    }

    /**
     * Insert a new family member record
     *
     * @param array $data Member details
     * @return bool
     */
    public function insert_member($data) {
        return $this->db->insert('family_members', $data);
    }

    /**
     * Update a family member record
     *
     * @param int $id Member ID
     * @param int $user_id User ID
     * @param array $data Updated details
     * @return bool
     */
    public function update_member($id, $user_id, $data) {
        $this->db->where(array('id' => $id, 'user_id' => $user_id));
        return $this->db->update('family_members', $data);
    }

    /**
     * Delete a family member record
     *
     * @param int $id Member ID
     * @param int $user_id User ID
     * @return bool
     */
    public function delete_member($id, $user_id) {
        $this->db->where(array('id' => $id, 'user_id' => $user_id));
        return $this->db->delete('family_members');
    }

    /**
     * Search candidates by name, phone, address, or pin code
     *
     * @param string $query
     * @return array
     */
    public function search_members($query) {
        $this->db->select('*');
        $this->db->from('family_members');
        $this->db->group_start();
        $this->db->like('first_name', $query);
        $this->db->or_like('middle_name', $query);
        $this->db->or_like('last_name', $query);
        $this->db->or_like('phone_number', $query);
        $this->db->or_like('business_phone', $query);
        $this->db->or_like('address', $query);
        $this->db->or_like('permanent_address', $query);
        $this->db->or_like('business_address', $query);
        $this->db->or_like('pin_code', $query);
        $this->db->group_end();
        
        $this->db->order_by("created_at", "DESC");
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
}
