<?php
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller {
/**
 * The Saving coupon
 * Author: Alberto Vera Espitia
 * GeekBucket 2014
 *
 */

	public function __construct() {
        parent::__construct();
        $this->load->database('default');
        $this->load->model('api_db');
        $this->load->model('cliente_cupon_db');
    }

	public function index_get() {
        $this->load->view('vwApi');
    }

    /**
     * Test connection
     */
    public function data_get() { 
        $idCliente = $this->get('id');
        $usuario = $this->api_db->getUserType($idCliente);
        $type = $usuario[0]->idTipoCupon;
            
        $cupones = $this->api_db->getCupones($idCliente, $type);
        $comercios = $this->api_db->getComercios($type);
        $xrefComerCat = $this->api_db->getXrefComerCat($type);
        $categories = $this->api_db->getCategories($type);
        
        // Set Captcha
        foreach ($cupones as $item):
            // Add new vars
            if ($item->code == null){
                $code = $this->getRandomCode();
                $item->code = $idCliente . $code  . $item->id; 
                $item->redimido = 1;
                $this->cliente_cupon_db->insert(array(
                              'idCliente' => $idCliente,
                              'idCupon' => $item->id,
                              'code' => $idCliente . $code  . $item->id,
                              'status' => 1));
            }
        endforeach;
        
        $this->response(array('success' => true, 
                              'cupones' => $cupones,
                              'comercios' => $comercios,
                              'xrefComerCat' => $xrefComerCat,
                              'categories' => $categories), 200);
    }
    

    // ------------------ METODOS GENERICOS ------------------ //
    
    /**
     * Obtiene un array sorting and sliced
     */
    public function sortSliceArray($array, $count){
        shuffle($array);
        if (count($array) > $count){
            $array = array_slice($array, 0, $count);
        }
        return $array;
    }
    
    /**
     * Genera codigo aleatorio
     */
    function getRandomCode(){
        $an = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
        $su = strlen($an) - 1;
        return substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1);
    }

}