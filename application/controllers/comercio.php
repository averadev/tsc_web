<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comercio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('cupon_db');
        $this->load->model('comercio_db');
    }

    public function index(){
        $comercio = $this->comercio_db->get($_GET['i'])[0];
        $cupones = $this->cupon_db->getCuponesPorComercio($_GET['i']);
        $data['id'] = $comercio->id;
        $data['nombre'] = $comercio->nombre;
        $data['direccion'] = $comercio->direccion;
        $data['servicios'] = $comercio->servicios;
        $data['correo'] = $comercio->correo;
        $data['telefono'] = $comercio->telefono;
        $data['banner'] = $comercio->banner;
        $data['latitud'] = $comercio->latitud;
        $data['longitud'] = $comercio->longitud;
        $data['cupones'] = $cupones;
        $this->load->view('vwComercio',$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
