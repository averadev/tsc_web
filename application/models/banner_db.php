<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class banner_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->from('banner');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->select('banner.id, banner.url, banner.descripcion, tipobanner.nombre as tipo, banner.paginaAsociada, comercio.nombre as comercio');
        $this->db->from('banner');
        $this->db->join('comercio', 'banner.idComercio = comercio.id ');
        $this->db->join('tipobanner', 'banner.idTipo = tipobanner.id ');
        $this->db->where('banner.status = 1');
        $this->db->order_by('banner.id');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getByTipo($tipo){
        $this->db->select('banner.id, banner.url, banner.descripcion, tipobanner.nombre as tipo, banner.paginaAsociada, comercio.nombre as comercio');
        $this->db->from('banner');
        $this->db->join('comercio', 'banner.idComercio = comercio.id ');
        $this->db->join('tipobanner', 'banner.idTipo = tipobanner.id ');
        $this->db->where('banner.status = 1');
        $this->db->where('banner.idTipo', $tipo);
        $this->db->order_by('banner.id');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $pagina){
        $this->db->select('banner.id, banner.url, banner.descripcion, tipobanner.nombre as tipo, comercio.nombre as comercio');
        $this->db->from('banner');
        $this->db->join('comercio', 'banner.idComercio = comercio.id ');
        $this->db->join('tipobanner', 'banner.idTipo = tipobanner.id ');
        $this->db->where('banner.status = 1 ');
        $this->db->where("(banner.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        $this->db->order_by("banner.id", "asc");
        if ($pagina > 0){
            $this->db->limit(10, (($pagina - 1)*10));
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la cuenta de registros de la consulta
     */
    public function getCount($texto){
        $this->db->select('count(banner.id) as total');
        $this->db->from('banner');
        $this->db->join('comercio', 'banner.idComercio = comercio.id ');
        $this->db->where('banner.status = 1 ');
        $this->db->where("(banner.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('banner', $data);
        return $this->db->insert_id();
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('banner', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('banner',  array('status' => 0));
    }
 
 	/**
	 * Obtiene la banner
	 */
    public function getbanner(){
    	$this->db->select('*');
		$this->db->from('banner');
		$this->db->where('status = 1');

    	return  $this->db->get()->result();
    }
 
}
//end model