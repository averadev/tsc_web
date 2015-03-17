<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class about extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('industria_db');
        $this->load->model('banner_db');
        $this->load->model('display_db');
        $this->load->model('tipocupon_db');
    }

    public function index(){
        $arr['page'] = 'home';
        $arr['banner1'] = $this->sortSliceArray($this->banner_db->getByTipo(1), 4);
        $this->load->view('vwAbout',$arr);
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
