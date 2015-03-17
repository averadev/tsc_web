<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dash extends CI_Controller {

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
        $this->load->model('cliente_cupon_db');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
		$id = $this->session->userdata('id');
		$arr['totales'] = $this->cliente_cupon_db->totales($id)[0];
		$arr['cupones'] = $this->cliente_cupon_db->cupones($id);
		$arr['page'] = 'dash';
        $this->load->view('admin/vwDash',$arr);
    }

    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function setCode(){
        if($this->input->is_ajax_request()){
            $isCupon = $this->cliente_cupon_db->get($_POST['key']);
            if (count($isCupon) == 0){
                echo json_encode(array("success" => 0, "message" => "El codigo es incorrecto."));
            }else{
                if ($isCupon[0]->status == 2){
                    echo json_encode(array("success" => 0, "message" => "El cupon fue canjeado con anterioridad."));
                }else{
                    $this->cliente_cupon_db->update($_POST);
                    echo json_encode(array("success" => 1, "message" => "Cupon aceptado."));
                }
            }
        }
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */