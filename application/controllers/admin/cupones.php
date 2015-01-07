<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cupones extends CI_Controller {
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
        $this->load->model('cupon_db');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $arr['page'] = 'cupon';
        $this->load->view('admin/vwCupon',$arr);
    }

    /**
     * Obtiene el registro seleccionado
     */
    public function get(){
        if($this->input->is_ajax_request()){
            $data = $this->cupon_db->get($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Eliminar el registro
     */
    public function delete(){
        if($this->input->is_ajax_request()){
            $data = $this->cupon_db->delete($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        if($this->input->is_ajax_request()){
            $data = $this->cupon_db->getAll();
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
            $total = $this->cupon_db->getCount($_POST['texto'])[0];
            $data = $this->cupon_db->getSearch($_POST['texto'], $pagina);

            // Formato a fechas
            foreach ($data as $obj){
                $obj->fechaInicio = strftime("%d de %B de %Y", strtotime($obj->fechaInicio));
                $obj->fechaFin = strftime("%d de %B de %Y", strtotime($obj->fechaFin));
            }

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
            $tipo = $_POST['tipo'];
            unset($_POST['tipo']);
            // Guardar cupon
            if ($_POST['id'] == '0'){
                unset($_POST['id']);
                $_POST['likes'] = 0;
                $_POST['id'] = $this->cupon_db->insert($_POST);
            }else{
                $this->cupon_db->update($_POST);
            }
            //echo $_POST['id'];
            // Guardar tipo
            $this->cupon_db->deleteTipo(array('idCupon' => $_POST['id']));
            if (strrpos($tipo, '1') > -1)
                $this->cupon_db->insertTipo(array('idCupon' => $_POST['id'], 'idTipoCupon' => 1));
            if (strrpos($tipo, '2') > -1)
                $this->cupon_db->insertTipo(array('idCupon' => $_POST['id'], 'idTipoCupon' => 2));
            if (strrpos($tipo, '3') > -1)
                $this->cupon_db->insertTipo(array('idCupon' => $_POST['id'], 'idTipoCupon' => 3));

            echo json_encode(array());
        }
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */