<?php
class Order_details_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function add_order_details($order_id, $items, $irsz, $varos, $cim, $hazszam){
        $success = true;
        foreach($items as $item){
            $order_details = [
                'order_id' => $order_id,
                'item_id' => $item['item_id'],
                'quantity' => 1,
                'postal_code' => $irsz,
                'city' => $varos,
                'street' => $cim,
                'number' => $hazszam
            ];
            
            if(!$this->db->insert('order_details', $order_details)){
                $success = false;
            }
        }
        
        return $success;
    }
}
