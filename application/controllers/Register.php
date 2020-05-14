<?php
class Register extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
    }
    
    public function index(){
        if($this->ion_auth->logged_in()){
            redirect('/');
        }
        $this->form_validation->set_rules('first_name', 'Keresztnév','required');
        $this->form_validation->set_rules('last_name', 'Vezetéknév','required');
        $this->form_validation->set_rules('username','Felhasználónév','required|is_unique[users.username]');
        $this->form_validation->set_rules('email','Email','valid_email|required|is_unique[users.email]');
        $this->form_validation->set_rules('password','Jelszó','min_length[8]|required');
        $this->form_validation->set_rules('confirm_password','Jelszó újra','matches[password]|required');
        
        $view_params = [];
        
        if($this->form_validation->run() === FALSE){
            $this->load->helper('form');
            $this->load->view('register/index', $view_params);
        }else{
            $firstname = $this->input->post('first_name');
            $lastname = $this->input->post('last_name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            
            $additional_data = [
                'first_name' => $firstname,
                'last_name' => $lastname
            ];
            
            if($this->ion_auth->register($username, $password, $email, $additional_data)){
                redirect('auth/login');
            }else{
                redirect('register');
            }
        }
    }
}
