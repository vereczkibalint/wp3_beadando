<?php
class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('pizza_model', 'pizza');
        $this->load->model('category_model', 'category');
        $this->load->helper('form');
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
}