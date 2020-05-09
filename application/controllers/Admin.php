<?php
class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index(){
        if(!$this->ion_auth->is_admin()){
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }else{
            $this->load->view('layout/header');
            $this->load->view('admin/index');
            $this->load->view('layout/footer');
        }
    }
}