<?php
class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('pizza_model', 'pizza');
        $this->load->model('category_model', 'category');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index(){
        if(!$this->ion_auth->is_admin()){
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }else{
            $this->load->view('admin/index');
        }
    }

    public function manage($type = null){
        if(!$this->ion_auth->is_admin()){
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }else{
            if($type == null){
                show_error('Hibás paraméterek!');
            }else{
                switch($type){
                    case 'users':
                        redirect('auth');
                    break;
                    case 'items':
                        $pizzas = $this->pizza->get_list();
                        $view_params = [
                            'pizzas' => $pizzas
                        ];
                        $this->load->view('admin/item_manage', $view_params);
                    break;
                    default:
                        show_error('Nem megfelelő paraméter!');
                    break;
                }
            }
        }
    }
    
    public function add_item(){
        if(!$this->ion_auth->is_admin()){
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }else{
            $view_params['categories'] = $this->category->get_list();
            if($this->input->post('submit')){
                $this->form_validation->set_rules('name','Megnevezés','required|min_length[4]|max_length[50]');
                $this->form_validation->set_rules('category','Kategória','numeric|required');
                $this->form_validation->set_rules('price','Ár','numeric|required|greater_than[0]|less_than[9999]');
                
                if($this->form_validation->run() === TRUE){
                    $upload_config['allowed_types'] = 'jpg|png|gif';
                    $upload_config['max_size'] = 5000;
                    $upload_config['min_height'] = 200;
                    $upload_config['max_height'] = 1000;
                    $upload_config['min_width'] = 200;
                    $upload_config['max_width'] = 1000;

                    $upload_config['upload_path'] = './uploads/pizza/';

                    $upload_config['file_ext_tolower'] = TRUE;
                    $upload_config['overwrite'] = FALSE; 

                    $this->upload->initialize($upload_config);
                    
                    if($this->upload->do_upload('image')){
                        $image_data = $this->upload->data();
                        if($this->pizza->insert($this->input->post('name'), $this->input->post('category'), $this->input->post('price'), $image_data['file_name'])){
                            $view_params['message'] = "Sikeres termékfelvétel!";
                            $this->load->view('admin/index', $view_params);
                        }else{
                            $view_params['categories'] = $this->category->get_list();
                            $view_params['message'] = "Hiba a termék felvitele közben!";
                            $this->load->view("admin/add_item", $view_params);
                        }
                    }else{
                        $view_params['categories'] = $this->category->get_list();
                        $view_params['message'] = $this->upload->display_errors();
                        $this->load->view("admin/add_item", $view_params);
                    }
                }else{
                    $view_params['categories'] = $this->category->get_list();
                    $this->load->view("admin/add_item");
                }
            }else{
                $view_params['categories'] = $this->category->get_list();
                $this->load->view('admin/add_item', $view_params);
            }
        }
    }
    
    public function edit_item($itemid = null){
       if(!$this->ion_auth->is_admin()){
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }else{
            if($itemid == null){
                show_error('Hibás paraméterek!');
            }else{
                $pizza = $this->pizza->select_by_id($itemid);
                $view_params['categories'] = $this->category->get_list();
                if($this->input->post('submit')){
                    $this->form_validation->set_rules('name','Megnevezés','required|min_length[4]|max_length[50]');
                    $this->form_validation->set_rules('category','Kategória','numeric|required');
                    $this->form_validation->set_rules('price','Ár','numeric|required|greater_than[0]|less_than[9999]');

                    if($this->form_validation->run() === TRUE){
                        if($this->pizza->update($itemid, $this->input->post('category'), $this->input->post('name') , $this->input->post('price'))){
                            $view_params['message'] = "Sikeres termékmódosítás!";
                            $this->load->view('admin/index',$view_params);
                        }else{
                            $view_params['pizza'] = $pizza;
                            $view_params['message'] = "Hiba a termék módosítása közben!";
                            $this->load->view("admin/edit_item", $view_params);
                        }
                    }
                }else{
                    $view_params['pizza'] = $pizza;
                    $this->load->view("admin/edit_item", $view_params);
                }
            }
        }
    }

    public function delete_item($itemid = null){
        if($this->ion_auth->is_admin()){
            if($itemid == null){
            show_error('Hiányzó paraméter!');
            }else{
                if($this->pizza->delete($itemid)){
                    redirect('admin/manage/items');
                }else{
                    show_error('Hiba a törlés közben!');
                }
            }
        }
        else{
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }
    }
    
    public function import_item(){
        if($this->ion_auth->is_admin()){
            $this->load->library('CSVParser', 'csvparser');
            if($this->input->post('submit')){
                $success = true;
                $this->form_validation->set_rules('import_file', 'CSV import fájl', 'callback_validate_csv');
                if($this->form_validation->run() === TRUE){
                    if(is_uploaded_file($_FILES['import_file']['tmp_name'])){
                        $csv_data = $this->csvparser->parse($_FILES['import_file']['tmp_name']);
                        if(!empty($csv_data)){
                            foreach($csv_data as $row){
                                $item = [
                                    'category_id' => $row['Category'],
                                    'name' => $row['Name'],
                                    'price' => $row['Price'],
                                    'image' => null
                                ];
                                
                                $category_id = $this->category->get_id_by_name($row['Category']);
                                if(empty($category_id)){
                                    $cat_id = $this->category->create($row['Category']);
                                    $item['category_id'] = $cat_id;
                                }else{
                                    $item['category_id'] = $category_id->category_id;
                                }
 
                                if(!$this->pizza->insert($item['name'], $item['category_id'], $item['price'], $item['image'])){
                                    $success = false;
                                }
                            }
                            
                            if($success){
                                $view_params['message'] = "Sikeres importálás!";
                                $this->load->view('admin/import_item', $view_params);
                            }else{
                                $view_params['message'] = "Sikertelen importálás!";
                                $this->load->view('admin/import_item', $view_params);
                            }
                        }
                    }else{
                        $view_params['message'] = "Hiba a fájl feltöltésekor!";
                        $this->load->view('admin/import_item', $view_params);
                    }
                }else{
                    $view_params['message'] = "Hibás fájl!";
                    $this->load->view('admin/import_item', $view_params);
                }
            }else{
                $view_params['message'] = "";
                $this->load->view('admin/import_item', $view_params);
            }
        }else{
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }
    }
    
    public function validate_csv($string){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['import_file']['name']) && $_FILES['import_file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['import_file']['name']);
            $file_array = explode('.', $_FILES['import_file']['name']);
            $extension = end($file_array);
            if(($extension == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_validation', 'Csak CSV fájl engedélyezett!');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_validation', 'Nem választott ki fájlt!');
            return false;
        }
    }
}