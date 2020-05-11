<?php
class Cart extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Cart_model', 'cart');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }
    
    public function index(){
        $items = $this->cart->get_cart();
        $total = 0;
        
        foreach($items as $item){
            $total += $item['price'];
        }
        
        $view_params = [
            'items' => $items,
            'total' => $total
        ];
        
        $this->load->view('cart/list', $view_params);
    }
    
    public function add($itemid = null){
        if($itemid == null){
            show_error('Hibás paraméter');
        }else{
            $this->cart->add_to_cart($itemid);
            redirect('cart');
        }
    }
    
    public function remove($itemid = null){
        if($itemid == null){
            show_error('Hibás paraméter!');
        }else{
            $this->cart->remove_from_cart($itemid);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function order(){
        $items = $this->cart->get_cart();
        
        $total = 0;

        foreach($items as $item){
            $total += $item['price'];
        }
        
        $view_params = [
                'items' => $items,
                'total' => $total
        ];
        
        if($this->input->post('submit')){
            $this->form_validation->set_rules('irsz', 'Irányítószám','numeric|required');
            $this->form_validation->set_rules('varos', 'Város','required');
            $this->form_validation->set_rules('cim', 'Cím','required');
            $this->form_validation->set_rules('hazszam', 'Házszám','numeric|required');
            
            if($this->form_validation->run() === TRUE){
                $this->cart->empty_cart();
                redirect('/');
            }else{
                $this->load->view('cart/order', $view_params);
            }

        }else{
            $this->load->view('cart/order', $view_params);
        }
    }
}

