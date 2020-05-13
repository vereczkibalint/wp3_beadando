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
    
    public function insert($name, $category, $price, $filename){
            $item = [
                'category_id' => $category,
                'name' => $name,
                'price' => $price,
                'image' => $filename
            ];
            return $this->db->insert('items', $item);
    }
    
    public function update($id, $category_id, $name, $price){
        $pizza = [
            'category_id' => $category_id,
            'name' => $name,
            'price' => $price
        ];
        
        $this->db->where('id', $id);
        
        return $this->db->update('items', $pizza);
    }
    
    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete('items');
    }
}