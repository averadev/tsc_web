<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('cupon_db');
        $this->load->model('industria_db');
        $this->load->model('publicidad_db');
        $this->load->model('banner_db');
        $this->load->model('display_db');
        $this->load->model('footerp_db');
        $this->load->model('tipocupon_db');
    }

    public function index(){
        $arr['page'] = 'home';
        $arr['banner1'] = $this->sortSliceArray($this->banner_db->getByTipo(1), 4);
        $arr['banner2'] = $this->sortSliceArray($this->banner_db->getByTipo(2), 4);
        $arr['display'] = $this->sortSliceArray($this->display_db->getAll(), 4);
        $arr['footer'] = $this->sortSliceArray($this->footerp_db->getAll(), 3);
        $this->load->view('vwHome',$arr);
    }

    /**
     * Obtiene los espacios publicitarios
     */
    public function cupon(){
        $data = $this->cupon_db->getCupon($_GET['id'])[0];
        $this->load->view('cupon', $data);
    }
    
    /**
     * Obtiene los espacios publicitarios del carrusel
     */
    public function getPublicidad(){
        if($this->input->is_ajax_request()){
            $data = $this->publicidad_db->getPublicidad();
            shuffle($data);
            echo json_encode($data);
        }
    }  

    /**
     * Obtiene todos los registros del catalogo Industria
     */
    public function getAllIndustria(){
        if($this->input->is_ajax_request()){
            $data = $this->industria_db->getAll();
            foreach ($data as $item):
                $item->sub = $this->industria_db->getAllSub($item->id);
            endforeach;
            echo json_encode($data);
        }
    }
    
    /**
     * Obtiene los precios de las cuponeras
     */
    public function getTipoCupon(){
        if($this->input->is_ajax_request()){
            $data = $this->tipocupon_db->getAll();
            echo json_encode($data);
        }
    }
    
    /**
     * Actualiza en uno, el like del cupon
     */
    public function setLikeCoupon(){
        if($this->input->is_ajax_request()){
            $coupon = $this->cupon_db->get($_POST['id']);
            $this->cupon_db->setLikeCoupon($coupon[0]);
        }
    }

    /**
     * Obtiene los cupones por tipo 
     */
    public function getCuponesPorTipo(){
        if($this->input->is_ajax_request()){
            $text = trim($_POST['texto']);
            if ($_POST['industria'] > 0){
                // cupones por industria
                $data = $this->cupon_db->getCuponesPorIndustria($_POST['industria']);
            }elseif ($text != ''){
                // cupones por industria
                $texts = preg_split('/\s+/', $text);
                $data = $this->cupon_db->getCuponesPorTexto($texts);
            }else{
                // cupones por tipo
                $data = $this->cupon_db->getCuponesPorTipo($_POST['tipo']);
            }
            echo json_encode($data);
        }
    }
    
    /**
     * Obtiene un array sorting and sliced
     */
    public function sortSliceArray($array, $count){
        // Suffle
        shuffle($array);
        // Slice
        if (count($array) > $count){
            $array = array_slice($array, 0, $count);
        }
        return $array;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
