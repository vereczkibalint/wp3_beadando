<?php
class Orders extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('order_model', 'order');
    }
    
    public function index(){
        if($this->ion_auth->logged_in()){
            
            $orders = $this->order->get_record_by_userid($this->ion_auth->user()->row()->id);
            
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
    
    public function details($id = null){
        if($this->ion_auth->logged_in()){
            if($id != null){
                $order = $this->order->get_order_by_id($id);
                die(var_dump($order));
                if($order == null){
                    show_error('Nincs ilyen rendelés az adatbázisban!');
                }else{
                    $view_params = [
                        'order' => $order
                    ];
                    
                    $this->load->view('layout/header');
                    $this->load->view('orders/details', $view_params);
                    $this->load->view('layout/footer');
                }
            }else{
                show_error('Hibás paraméterek!');
            }
        }else{
            redirect('auth/login');
        }
    }
}
