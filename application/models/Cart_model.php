<?php
class Cart_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_cart(){
        if(!$this->ion_auth->logged_in()){
            show_error('Ehhez a funkcióhoz be kell jelentkezni!');
        }else{
            $this->db->select('cart.cart_id, cart.item_id, cart.user_id, items.name, items.price, cart.quantity');
            $this->db->from('cart');
            $this->db->join('items', 'cart.item_id = items.id');
            $this->db->where('cart.user_id', $this->ion_auth->get_user_id());

            $query = $this->db->get();

            $cart = $query->result_array();

            return $cart;
        }
    }
    
    public function add_to_cart($itemid){
        $insert = [
            'user_id' => $this->ion_auth->user()->row()->id,
            'item_id' => $itemid
        ];
        
        return $this->db->insert('cart',$insert);
    }
    
    public function remove_from_cart($item_id){
        return $this->db->delete('cart', ['item_id' => $item_id], 1);
    }
    
    public function empty_cart(){
        return $this->db->delete('cart', ['user_id' => $this->ion_auth->get_user_id()]);
    }
}
