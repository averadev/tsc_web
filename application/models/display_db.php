<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class display_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->from('display');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->select('display.id, display.url, display.descripcion, display.paginaAsociada, comercio.nombre as comercio');
        $this->db->from('display');
        $this->db->join('comercio', 'display.idComercio = comercio.id ');
        $this->db->where('display.status = 1');
        $this->db->order_by('display.id');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $pagina){
        $this->db->select('display.id, display.url, display.descripcion, comercio.nombre as comercio');
        $this->db->from('banner');
        $this->db->join('comercio', 'display.idComercio = comercio.id ');
        $this->db->where('display.status = 1 ');
        $this->db->where("(display.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        $this->db->order_by("display.id", "asc");
        if ($pagina > 0){
            $this->db->limit(10, (($pagina - 1)*10));
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la cuenta de registros de la consulta
     */
    public function getCount($texto){
        $this->db->select('count(display.id) as total');
        $this->db->from('display');
        $this->db->join('comercio', 'display.idComercio = comercio.id ');
        $this->db->where('display.status = 1 ');
        $this->db->where("(display.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('display', $data);
        return $this->db->insert_id();
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('display', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('display',  array('status' => 0));
    }
 
}
//end model