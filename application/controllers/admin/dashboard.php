<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database('default');
        $this->load->model('cupon_db');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $arr['page']='dash';
        $this->load->view('admin/vwDashboard',$arr);
    }

    /**
     * Obtiene cupones por comercio
     */
    public function cuponesComercio(){
        if($this->input->is_ajax_request()){
            $data = $this->cupon_db->cuponesComercio();
            echo json_encode($data);
        }
    }

    /**
     * Obtiene cupones por industria
     */
    public function cuponesIndustria(){
        if($this->input->is_ajax_request()){
            $data = $this->cupon_db->cuponesIndustria();
            echo json_encode($data);
        }
    }

    /**
     * Obtiene cupones por tipo
     */
    public function cuponesTipo(){
        if($this->input->is_ajax_request()){
            $data = $this->cupon_db->cuponesTipo();
            echo json_encode($data);
        }
    }

    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */