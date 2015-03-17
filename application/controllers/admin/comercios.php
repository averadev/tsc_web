<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comercios extends CI_Controller {
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
        $this->load->model('comercio_db');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $arr['page'] = 'comercio';
        $this->load->view('admin/vwComercio',$arr);
    }

    /**
     * Obtiene el registro seleccionado
     */
    public function get(){
        if($this->input->is_ajax_request()){
            $data = $this->comercio_db->get($_POST['id']);
            $inds = $this->comercio_db->getIndustrias($_POST['id']);
            echo json_encode(array(
                'industrias'=>$inds,
                'comercio'=>$data));
        }
    }

    /**
     * Eliminar el registro
     */
    public function delete(){
        if($this->input->is_ajax_request()){
            $data = $this->comercio_db->delete($_POST['id']);
            echo json_encode($data);
        }
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        if($this->input->is_ajax_request()){
            $data = $this->comercio_db->getAll();
            echo json_encode($data);
        }
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAllCatalogo(){
        if($this->input->is_ajax_request()){
            $data = $this->comercio_db->getAllCatalogo();
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
            $total = $this->comercio_db->getCount($_POST['texto'])[0];
            $data = $this->comercio_db->getSearch($_POST['texto'], $pagina);
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
            $idComercio = $_POST['id'];
            $industrias = preg_split('/\s+/', $_POST['industrias']);
            unset($_POST['industrias']);
            // Quitamos el password en caso de venir vacio
            if ($_POST['password'] == ''){
                unset($_POST['password']);
            }else{
                $_POST['password'] = md5($_POST['password']);
            }
            
            if ($idComercio == '0'){
                unset($_POST['id']);
                $this->comercio_db->insert($_POST);
            }else{
                $this->comercio_db->update($_POST);
            }

            // Actualizar Industrias
            $this->comercio_db->deleteIndustrias(array('idComercio' => $idComercio));
            foreach ($industrias as $idIndustria){
                $this->comercio_db->insertIndustrias(array('idComercio'=>$idComercio, 'idIndustria'=>$idIndustria));
            }
            echo json_encode(array());
        }
    }
    
    public function sendPass(){
        
        $email = $_POST['usuario'];
        $password = $_POST['password'];
    	
        // mensaje
        $mensaje = '
        <html>
            <body>
                <div style="width:100%; height:5px; background: #f79c43;"></div>
                <div style="width:100%; height:20px; background: #000; font-size:20px; color:#ffffff; padding: 10px 0 10px 50px; ">
                    Informacion de acceso, The Saving Coupon
                </div>

                <br/><br/>
                <div style="width:100%; margin: 20px 0;">
                    <h3>Hola!, los datos de acceso a nuestro portal son los siguientes:</h3>
                    
                    <p style="font-family:Georgia; font-size:18px;">Link: <a href="http://thesavingcoupon.com/admin">thesavingcoupon.com/admin</a></p>
                    <p style="font-family:Georgia; font-size:18px;">Correo: '.$email.'</p>
                    <p style="font-family:Georgia; font-size:18px;">Password: '.$password.'</p>

                </div>
                <br/><br/><br/><br/>

                <div style="width:100%; height:30px; background: #000; font-size:18px; font-weight: bold; color:#ffffff;"></div>
                <div style="width:100%; height:5px; background: #f79c43;"></div>

            </body>
        </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: Contacto <contacto@thesavingcoupon.com>';

        // Enviarlo
        mail($email, "Registro The Saving Coupon", $mensaje, $cabeceras);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */