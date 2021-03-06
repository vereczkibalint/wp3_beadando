<?php
class Pizza extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('pizza_model', 'pizza');
        $this->load->helper('form');
        $this->load->helper('url');
    }
    
    public function index(){

        $pizzas = $this->pizza->get_list();
        
        $data['pizzas'] = $pizzas;
        
        $this->load->view('layout/header');
        $this->load->view('pizza/list', $data);
        $this->load->view('layout/footer');
    }
}
?>