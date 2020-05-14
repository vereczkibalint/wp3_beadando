<?php
class Category_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_list(){
        $this->db->select('*');
        $this->db->from('item_categories');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function get_id_by_name($category_name){
        $this->db->select('category_id');
        $this->db->from('item_categories');
        $this->db->where('category_name', $category_name);
        
        return $this->db->get()->row();
    }
    
    public function create($category_name){
        $category = [
            'category_name' => $category_name
        ];
        
        $this->db->insert('item_categories', $category);
        
        return $this->db->insert_id();
    }
}