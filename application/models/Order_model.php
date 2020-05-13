<?php
class Order_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('ion_auth');
    }
    
    public function get_list(){
        $this->db->select('orders.order_id, orders.order_date, sum(items.price * order_details.quantity)');
        $this->db->from('orders');
        $this->db->join('order_details', 'orders.order_id = order_details.order_id');
        $this->db->join('items', 'order_details.item_id = items.id');
        $this->db->group_by('orders.order_id');
        $this->db->order_by('order_date', 'ASC');
       
        $query = $this->db->get();
        
        $result = $query->result();
        
        return $result;
    }
    
    public function get_record_by_userid($userid){
        $this->db->select('orders.order_id, orders.order_date, sum(items.price * order_details.quantity) as sumprice');
        $this->db->from('orders');
        $this->db->join('order_details', 'orders.order_id = order_details.order_id');
        $this->db->join('items', 'order_details.item_id = items.id');
        $this->db->where('orders.user_id', $userid);
        $this->db->group_by('orders.order_id');
        $this->db->order_by('order_date', 'ASC');
        
        
        
        return $this->db->get()->result_array();
    }
    
    public function get_order_by_id($orderid, $userid){
        $this->db->select('items.name, items.price, order_details.quantity, order_details.postal_code, order_details.city, order_details.street, order_details.number');
        $this->db->from('orders');
        $this->db->join('order_details', 'orders.order_id = order_details.order_id');
        $this->db->join('items', 'order_details.item_id = items.id');
        $this->db->where('orders.user_id', $userid);
        $this->db->where('orders.order_id', $orderid);
        
        return $this->db->get()->result_array();
    }
    
    public function add_order($user_id){
        $order_record = [
            'user_id' => $user_id,
            'order_date' => date('Y-m-d h:i:s')
        ];
        
        $this->db->insert('orders', $order_record);
        
        return $this->db->insert_id();
    }
}
