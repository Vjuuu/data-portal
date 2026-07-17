<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the user model
        $this->load->model('User_model');
        // Ensure security headers are set
        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
    }

    /**
     * User registration page and handler
     */
    public function register() {
        // If already logged in, redirect to dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[100]|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric|min_length[10]|max_length[15]|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

        // Customize error messages wrapper
        $this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Create Secure Account';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            // Save data
            $userData = array(
                'name'     => $this->input->post('name', TRUE), // Enable XSS filtering
                'phone'    => $this->input->post('phone', TRUE),
                'email'    => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );

            if ($this->User_model->insert_user($userData)) {
                $this->session->set_flashdata('success', 'Registration successful! Please login with your credentials.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                redirect('register');
            }
        }
    }

    /**
     * User login page and handler
     */
    public function login() {
        // If already logged in, redirect to dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Secure Portal Login';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password');

            // Find user
            $user = $this->User_model->get_user_by_email($email);

            if ($user && password_verify($password, $user['password'])) {
                // Regenerate session ID to prevent Session Fixation attacks
                $this->session->sess_regenerate();

                // Setup session payload
                $sessionData = array(
                    'user_id'   => $user['id'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($sessionData);
                $this->session->set_flashdata('success', 'Welcome back, ' . $user['name'] . '!');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('login');
            }
        }
    }

    /**
     * User Dashboard (Protected view)
     */
    public function dashboard() {
        // Redirect to login if user is not authenticated
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Access denied. Please log in first.');
            redirect('login');
        }

        // Fetch fresh details from DB to display
        $userId = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($userId);
        
        if (empty($data['user'])) {
            $this->session->sess_destroy();
            redirect('login');
        }

        // Fetch user's family members (including Self details)
        $data['members'] = $this->User_model->get_members($userId);
        $data['self_info'] = $this->User_model->get_member_by_relation($userId, 'Self');

        $data['title'] = 'User Dashboard';

        $this->load->view('public/header', $data);
        $this->load->view('auth/dashboard', $data);
        $this->load->view('public/footer');
    }

    /**
     * Add/Edit member form page
     */
    public function member_form($action = 'add', $id = null) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $userId = $this->session->userdata('user_id');
        $data['member'] = null;
        $data['is_self'] = 0;
        $data['title'] = 'Add Family Member';

        if ($action === 'self') {
            $data['member'] = $this->User_model->get_member_by_relation($userId, 'Self');
            $data['is_self'] = 1;
            $data['title'] = $data['member'] ? 'Edit My Details' : 'Add My Details (Self)';
        } elseif ($action === 'edit' && !empty($id)) {
            $data['member'] = $this->User_model->get_member_by_id($id, $userId);
            if (!$data['member']) {
                $this->session->set_flashdata('error', 'Member not found.');
                redirect('dashboard');
            }
            if ($data['member']['relation'] === 'Self') {
                $data['is_self'] = 1;
                $data['title'] = 'Edit My Details';
            } else {
                $data['title'] = 'Edit Family Member (' . $data['member']['relation'] . ')';
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('auth/member_form', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Add or Edit self/family member information
     */
    public function save_member() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $userId = $this->session->userdata('user_id');
        $memberId = $this->input->post('member_id');

        // Set Validation Rules
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('middle_name', 'Middle Name', 'alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[Male,Female,Other]|trim');
        $this->form_validation->set_rules('relation', 'Relation', 'required|trim');
        $this->form_validation->set_rules('education', 'Education', 'required|trim');
        $this->form_validation->set_rules('occupation', 'Occupation', 'required|in_list[Service,Business,Housewife,Retired]|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|min_length[10]|max_length[15]|trim');

        $occupation = $this->input->post('occupation');
        if ($occupation === 'Service') {
            $this->form_validation->set_rules('company_name', 'Company Name', 'required|trim');
        } elseif ($occupation === 'Business') {
            $this->form_validation->set_rules('business_name', 'Business Name', 'required|trim');
            $this->form_validation->set_rules('business_nature', 'Business Nature/Type', 'required|trim');
            $this->form_validation->set_rules('business_address', 'Business Address', 'required|trim');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors(' ', ' '));
            $is_self = $this->input->post('is_self');
            $memberId = $this->input->post('member_id');
            if ($is_self == 1) {
                redirect('member/self');
            } elseif (!empty($memberId)) {
                redirect('member/edit/' . $memberId);
            } else {
                redirect('member/add');
            }
        } else {
            $relation = $this->input->post('relation', TRUE);
            
            // Force relation to 'Self' if user indicates it is self details
            if ($this->input->post('is_self') == 1) {
                $relation = 'Self';
            }

            // Ensure no duplicate 'Self' record is created for this user
            if ($relation === 'Self' && empty($memberId)) {
                $existingSelf = $this->User_model->get_member_by_relation($userId, 'Self');
                if ($existingSelf) {
                    $memberId = $existingSelf['id'];
                }
            }

            $data = array(
                'user_id'          => $userId,
                'relation'         => $relation,
                'first_name'       => $this->input->post('first_name', TRUE),
                'middle_name'      => $this->input->post('middle_name', TRUE) ? $this->input->post('middle_name', TRUE) : NULL,
                'last_name'        => $this->input->post('last_name', TRUE),
                'gender'           => $this->input->post('gender', TRUE),
                'education'        => $this->input->post('education', TRUE),
                'occupation'       => $occupation,
                'company_name'     => ($occupation === 'Service') ? $this->input->post('company_name', TRUE) : NULL,
                'business_name'    => ($occupation === 'Business') ? $this->input->post('business_name', TRUE) : NULL,
                'business_nature'  => ($occupation === 'Business') ? $this->input->post('business_nature', TRUE) : NULL,
                'business_address' => ($occupation === 'Business') ? $this->input->post('business_address', TRUE) : NULL,
                'phone_number'     => $this->input->post('phone_number', TRUE)
            );

            // Handle Profile Photo Upload if relation is Self and file is provided
            if ($relation === 'Self' && !empty($_FILES['profile_photo']['name'])) {
                if (!is_dir('./assets/uploads')) {
                    mkdir('./assets/uploads', 0755, TRUE);
                }

                $config['upload_path']   = './assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = 2048; // 2MB max
                $config['encrypt_name']  = TRUE; // Prevent name conflicts and traversal

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('profile_photo')) {
                    $uploadData = $this->upload->data();
                    $data['profile_photo'] = 'assets/uploads/' . $uploadData['file_name'];

                    // Optional: delete old profile photo if updating
                    if (!empty($memberId)) {
                        $oldMember = $this->User_model->get_member_by_id($memberId, $userId);
                        if ($oldMember && !empty($oldMember['profile_photo']) && file_exists('./' . $oldMember['profile_photo'])) {
                            unlink('./' . $oldMember['profile_photo']);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Image upload error: ' . $this->upload->display_errors('', ''));
                    if ($this->input->post('is_self') == 1) {
                        redirect('member/self');
                    } elseif (!empty($memberId)) {
                        redirect('member/edit/' . $memberId);
                    } else {
                        redirect('member/add');
                    }
                }
            }

            if (!empty($memberId)) {
                // Update
                if ($this->User_model->update_member($memberId, $userId, $data)) {
                    $this->session->set_flashdata('success', 'Information updated successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Could not update information.');
                }
            } else {
                // Insert
                if ($this->User_model->insert_member($data)) {
                    $this->session->set_flashdata('success', 'Information added successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Could not save information.');
                }
            }

            redirect('dashboard');
        }
    }

    /**
     * Delete a family member record
     *
     * @param int $id Member ID
     */
    public function delete_member($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $userId = $this->session->userdata('user_id');
        $member = $this->User_model->get_member_by_id($id, $userId);

        if ($member && $member['relation'] !== 'Self') {
            if ($this->User_model->delete_member($id, $userId)) {
                $this->session->set_flashdata('success', 'Family member deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete family member.');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid action or member not found.');
        }

        redirect('dashboard');
    }

    /**
     * User logout handler
     */
    public function logout() {
        // Destroy the current session
        $this->session->sess_destroy();
        redirect('login');
    }
}
