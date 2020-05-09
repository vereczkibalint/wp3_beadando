<?php
class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index(){
        if(!$this->ion_auth->is_admin()){
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }else{
            $this->load->view('layout/header');
            $this->load->view('admin/index');
            $this->load->view('layout/footer');
        }
    }

    public function manage($type = null){
        if(!$this->ion_auth->is_admin()){
            show_error('Az oldal megtekintéséhez admin jogosultság szükséges!');
        }else{
            if($type == null){
                show_error('Hibás paraméterek!');
            }else{
                $this->load->view('layout/header');
                switch($type){
                    case 'users':
                        redirect('auth');
                    break;
                    case 'items':
                        $this->load->view('admin/item_manage');
                        $this->load->view('layout/footer');
                    break;
                    default:
                        show_error('Nem megfelelő paraméter!');
                    break;
                }
            }
        }
    }
}