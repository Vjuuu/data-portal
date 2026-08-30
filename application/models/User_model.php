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
     * Only returns records where both user and candidate are visible
     *
     * @param string $query
     * @return array
     */
    public function search_members($query) {
        $this->db->select('family_members.*, users.name as account_holder, users.email as account_email');
        $this->db->from('family_members');
        $this->db->join('users', 'family_members.user_id = users.id', 'inner');
        
        // Exclude hidden users and hidden candidates
        $this->db->where('family_members.is_visible', 1);
        $this->db->where('users.is_visible', 1);

        $this->db->group_start();
        $this->db->like('family_members.first_name', $query);
        $this->db->or_like('family_members.middle_name', $query);
        $this->db->or_like('family_members.last_name', $query);
        $this->db->or_like('family_members.phone_number', $query);
        $this->db->or_like('family_members.business_phone', $query);
        $this->db->or_like('family_members.address', $query);
        $this->db->or_like('family_members.permanent_address', $query);
        $this->db->or_like('family_members.business_address', $query);
        $this->db->or_like('family_members.pin_code', $query);
        $this->db->group_end();
        
        $this->db->order_by("family_members.created_at", "DESC");
        $query_result = $this->db->get();
        return $query_result->result_array();
    }

    /**
     * Update user payment status
     *
     * @param int $user_id
     * @param string $status ('paid', 'unpaid', 'pending')
     * @param float $amount
     * @return bool
     */
    public function update_payment_status($user_id, $status = 'paid', $amount = 5999.00) {
        $data = array(
            'payment_status' => $status,
            'paid_at'        => ($status === 'paid') ? date('Y-m-d H:i:s') : NULL,
            'plan_amount'    => ($status === 'paid') ? $amount : NULL
        );
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    /**
     * Insert a payment transaction record
     *
     * @param array $data
     * @return int|bool Insert ID or false
     */
    public function create_payment_record($data) {
        if ($this->db->insert('payments', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * Update a payment record by order_id
     *
     * @param string $order_id
     * @param array $data
     * @return bool
     */
    public function update_payment_by_order_id($order_id, $data) {
        $this->db->where('order_id', $order_id);
        return $this->db->update('payments', $data);
    }

    /**
     * Get payment record by order_id
     *
     * @param string $order_id
     * @return array|null
     */
    public function get_payment_by_order_id($order_id) {
        $query = $this->db->get_where('payments', array('order_id' => $order_id), 1);
        return $query->row_array();
    }

    /**
     * Get payment record by ID
     *
     * @param int $payment_id
     * @param int|null $user_id
     * @return array|null
     */
    public function get_payment_by_id($payment_id, $user_id = null) {
        $where = array('id' => $payment_id);
        if (!empty($user_id)) {
            $where['user_id'] = $user_id;
        }
        $query = $this->db->get_where('payments', $where, 1);
        return $query->row_array();
    }

    /**
     * Get all payment records for a user
     *
     * @param int $user_id
     * @return array
     */
    public function get_user_payments($user_id) {
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get_where('payments', array('user_id' => $user_id));
        return $query->result_array();
    }

    /* =========================================================================
       SUPER ADMIN METHODS
       ========================================================================= */

    /**
     * Get dashboard summary statistics
     *
     * @return array
     */
    public function get_admin_stats() {
        // Total Users
        $totalUsers = $this->db->count_all('users');

        // Total Paid Users
        $this->db->where('payment_status', 'paid');
        $paidUsers = $this->db->count_all_results('users');

        // Total Unpaid Users
        $this->db->where('payment_status !=', 'paid');
        $unpaidUsers = $this->db->count_all_results('users');

        // Total Family Members / Candidates
        $totalMembers = $this->db->count_all('family_members');

        // Total Revenue Sum
        $this->db->select_sum('amount');
        $this->db->where('status', 'paid');
        $revQuery = $this->db->get('payments');
        $revRow = $revQuery->row_array();
        $totalRevenue = !empty($revRow['amount']) ? (float)$revRow['amount'] : 0.00;

        // Visible vs Hidden Users
        $this->db->where('is_visible', 1);
        $visibleUsers = $this->db->count_all_results('users');

        $this->db->where('is_visible', 0);
        $hiddenUsers = $this->db->count_all_results('users');

        return array(
            'total_users'    => $totalUsers,
            'paid_users'     => $paidUsers,
            'unpaid_users'   => $unpaidUsers,
            'total_members'  => $totalMembers,
            'total_revenue'  => $totalRevenue,
            'visible_users'  => $visibleUsers,
            'hidden_users'   => $hiddenUsers
        );
    }

    /**
     * Get users list with filters for Admin panel
     *
     * @param string $search
     * @param string $status ('paid', 'unpaid')
     * @param string $visibility ('1', '0')
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get_admin_users($search = '', $status = '', $visibility = '', $limit = 50, $offset = 0) {
        $this->db->select('users.*, COUNT(family_members.id) as members_count');
        $this->db->from('users');
        $this->db->join('family_members', 'users.id = family_members.user_id', 'left');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('users.email', $search);
            $this->db->or_like('users.phone', $search);
            $this->db->group_end();
        }

        if ($status === 'paid') {
            $this->db->where('users.payment_status', 'paid');
        } elseif ($status === 'unpaid') {
            $this->db->where('users.payment_status !=', 'paid');
        }

        if ($visibility !== '' && $visibility !== null) {
            $this->db->where('users.is_visible', (int)$visibility);
        }

        $this->db->group_by('users.id');
        $this->db->order_by('users.created_at', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Count users for pagination with filters
     */
    public function count_admin_users($search = '', $status = '', $visibility = '') {
        $this->db->from('users');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone', $search);
            $this->db->group_end();
        }

        if ($status === 'paid') {
            $this->db->where('payment_status', 'paid');
        } elseif ($status === 'unpaid') {
            $this->db->where('payment_status !=', 'paid');
        }

        if ($visibility !== '' && $visibility !== null) {
            $this->db->where('is_visible', (int)$visibility);
        }

        return $this->db->count_all_results();
    }

    /**
     * Toggle public search visibility for a user and cascade to their members
     *
     * @param int $user_id
     * @param int $is_visible (1 or 0)
     * @return bool
     */
    public function toggle_user_visibility($user_id, $is_visible) {
        $status = $is_visible ? 1 : 0;
        
        // 1. Update users table
        $this->db->where('id', $user_id);
        $userUpdated = $this->db->update('users', array('is_visible' => $status));

        // 2. Cascade to user's family members
        $this->db->where('user_id', $user_id);
        $this->db->update('family_members', array('is_visible' => $status));

        return $userUpdated;
    }

    /**
     * Get all payment records for Super Admin
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get_all_payments_admin($limit = 50, $offset = 0) {
        $this->db->select('payments.*, users.name as user_name, users.email as user_email, users.phone as user_phone');
        $this->db->from('payments');
        $this->db->join('users', 'payments.user_id = users.id', 'left');
        $this->db->order_by('payments.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Retrieve a setting by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get_setting($key, $default = null) {
        $query = $this->db->get_where('settings', array('key' => $key), 1);
        $row = $query->row_array();
        return ($row && isset($row['value'])) ? $row['value'] : $default;
    }

    /**
     * Set or update a setting
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function set_setting($key, $value) {
        $exists = $this->db->get_where('settings', array('key' => $key), 1)->row_array();
        if ($exists) {
            $this->db->where('key', $key);
            return $this->db->update('settings', array('value' => (string)$value));
        } else {
            return $this->db->insert('settings', array('key' => $key, 'value' => (string)$value));
        }
    }

    /**
     * Get all settings as key-value associative array
     *
     * @return array
     */
    public function get_all_settings() {
        $query = $this->db->get('settings');
        $result = $query->result_array();
        $settings = array();
        foreach ($result as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }
}



