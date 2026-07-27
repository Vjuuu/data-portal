<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Secure headers
        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
    }

    /**
     * Public landing page index
     */
    public function index() {
        $data['title'] = 'Home';

        // Check if there is a form submission
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[100]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
            $this->form_validation->set_rules('subject', 'Subject', 'required|min_length[3]|max_length[150]|trim');
            $this->form_validation->set_rules('message', 'Message', 'required|min_length[10]|trim');

            $this->form_validation->set_error_delimiters('<div class="error-msg text-danger mt-1" style="font-size: 0.85rem; font-weight: 500;">', '</div>');

            if ($this->form_validation->run() === TRUE) {
                // mock message storage or sending
                $name = $this->input->post('name', TRUE);
                $this->session->set_flashdata('success', "Thank you, {$name}! Your message has been sent successfully.");
                redirect('home#contact');
            } else {
                $this->session->set_flashdata('error', 'There was an issue sending your message. Please correct the errors below.');
            }
        }

        $this->load->view('public/header', $data);
        $this->load->view('public/home');
        $this->load->view('public/footer');
    }

    /**
     * Search page for candidates
     */
    public function search() {
        $query = $this->input->get('query', TRUE);
        $data['title'] = 'शोध निकाल (Search Results)';
        $data['search_query'] = $query;
        $data['results'] = array();

        $this->load->model('User_model');

        if (!empty(trim($query))) {
            $data['results'] = $this->User_model->search_members($query);
        }

        $this->load->view('public/header', $data);
        $this->load->view('public/search_results', $data);
        $this->load->view('public/footer');
    }
}
