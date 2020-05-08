<?php
class Order_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_list(){
        $this->db->select('orders.order_id, orders.order_date, items.name, order_details.quantity, sum(items.price * order_details.quantity)');
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
        $this->db->select('orders.order_id, orders.order_date, order_details.item_id, order_details.quantity');
        $this->db->from('orders');
        $this->db->join('order_details', 'orders.order_id = order_details.order_id');
        $this->db->order_by('order_date', 'ASC');
        $this->db->where('orders.user_id', $userid);
        
        return $this->db->get()->row();
    }
}
