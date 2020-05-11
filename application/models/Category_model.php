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
}