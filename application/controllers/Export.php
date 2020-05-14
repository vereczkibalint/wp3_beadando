<?php
class Export extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Pizza_model', 'pizza');
    }
    
    public function export_menu(){
        $pizzas = $this->pizza->get_list();
         
        $fp = fopen('php://output', 'w+'); 
        header('Content-type: application/octet-stream');  
        header('Content-disposition: attachment; filename="menu.csv"'); 
        
        fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 fix
        $header = array("Termék neve","Termék ára"); 
        fputcsv($fp, $header,";");
        
        foreach($pizzas as $pizza){
            fputcsv($fp, [$pizza['name'], $pizza['price'] . 'Ft'], ';', ' ');
        }
        
        fclose($fp);
        exit();
    }
}
