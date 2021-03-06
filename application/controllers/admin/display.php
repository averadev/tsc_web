<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Display extends CI_Controller {
/**
 * The Saving coupon
 * Author: Alberto Vera Espitia
 * GeekBucket 2014
 *
 */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database('default');
        $this->load->model('display_db');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $arr['page'] = 'display';
        $this->load->view('admin/vwDisplay',$arr);
    }

    /**
     * Obtiene el registro seleccionado
     */
    public function get(){
        if($this->input->is_ajax_request()){
            $data = $this->display_db->get($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        if($this->input->is_ajax_request()){
            $data = $this->display_db->getAll();
            echo json_encode($data);
        }
    }

    /**
     * Eliminar el registro
     */
    public function delete(){
        if($this->input->is_ajax_request()){
            $data = $this->display_db->delete($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch(){
        if($this->input->is_ajax_request()){
            // Consulta tamaño consulta
            $pagina = $_POST['pagina'];
            $total = $this->display_db->getCount($_POST['texto'])[0];
            $data = $this->display_db->getSearch($_POST['texto'], $pagina);

            echo json_encode(array(
                'pagina'=>$pagina,
                'total'=>$total->total,
                'data'=>$data));
        }
    }

    /**
     * Guarda el registro
     */
    public function save(){
        if($this->input->is_ajax_request()){
            if ($_POST['id'] == '0'){
                unset($_POST['id']);
                $this->display_db->insert($_POST);
            }else{
                $this->display_db->update($_POST);
            }
            echo json_encode(array());
        }
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */