<?php
class Pizza_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_list(){
        $this->db->select('items.id, items.name, items.price, items.image, item_categories.category_name');
        $this->db->from('items');
        $this->db->join('item_categories', 'items.category_id = item_categories.category_id');
        $this->db->order_by('id', 'ASC');
        
        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }
    
    public function select_by_id($id){
        $this->db->select('items.id, items.name, items.price, items.image, item_categories.category_name');
        $this->db->from('items');
        $this->db->join('item_categories', 'items.category_id = item_categories.category_id');
        $this->db->where('items.id', $id);
        
        return $this->db->get()->row();
    }
    
    public function insert($item){
        $query = $this->db->get_where('items', ['name' => $item['name']]);
        
        $item_count = $query->num_rows();
        
        if($item_count > 0){
            return -1;
        }else{
            $this->db->insert('items', $item);
            return $this->db->insert_id();
        }
    }
    
    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete('items');
    }
}