<?php
class Orders extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('order_model', 'order');
    }
    
    public function index(){
        if($this->ion_auth->logged_in()){
            $orders = $this->order->get_list();
            $view_params = [
                'orders' => $orders
            ];
            $this->load->view('layout/header');
            $this->load->view('orders/list', $view_params);
            $this->load->view('layout/footer');
        }
        else{
            redirect('auth/login');
        }
    }
}
