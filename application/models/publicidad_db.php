<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class publicidad_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->from('publicidad');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->from('publicidad');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $pagina){
        $this->db->select('publicidad.id, publicidad.url, publicidad.fechaInicio, publicidad.fechaFin, publicidad.descripcion, comercio.nombre as comercio');
        $this->db->from('publicidad');
        $this->db->join('comercio', 'publicidad.idComercio = comercio.id ');
        $this->db->where('publicidad.status = 1 ');
        $this->db->where("(publicidad.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        $this->db->order_by("publicidad.id", "asc");
        if ($pagina > 0){
            $this->db->limit(10, (($pagina - 1)*10));
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la cuenta de registros de la consulta
     */
    public function getCount($texto){
        $this->db->select('count(publicidad.id) as total');
        $this->db->from('publicidad');
        $this->db->join('comercio', 'publicidad.idComercio = comercio.id ');
        $this->db->where('publicidad.status = 1 ');
        $this->db->where("(publicidad.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('publicidad', $data);
        return $this->db->insert_id();
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('publicidad', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('publicidad',  array('status' => 0));
    }
 
 	/**
	 * Obtiene la publicidad
	 */
    public function getPublicidad(){
    	$this->db->select('publicidad.url, publicidad.paginaAsociada, publicidad.descripcion, comercio.nombre as comercio');
		$this->db->from('publicidad');
        $this->db->join('comercio', 'publicidad.idComercio = comercio.id ');
		$this->db->where('publicidad.status = 1');
		$this->db->where('publicidad.fechaInicio <= CURDATE()');
		$this->db->where('publicidad.fechaFin >= CURDATE()');

    	return  $this->db->get()->result();
    }
 
}
//end model