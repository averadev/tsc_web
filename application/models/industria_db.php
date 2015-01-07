<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class industria_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->select("id, nombre, idPadre, if(idPadre is null, '', (select ind.nombre from industria ind where ind.id = industria.idPadre)) as padre", false);
        $this->db->from('industria');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->from('industria');
        $this->db->where('status = 1');
        $this->db->where('idPadre is null');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAllSub($id){
        $this->db->from('industria');
        $this->db->where('status = 1');
        $this->db->where('idPadre', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $pagina){
        $this->db->select("id, , if(idPadre is null, nombre, concat((select ind.nombre from industria ind where ind.id = industria.idPadre), ' -> ', nombre)) as nombre", false);
        $this->db->from('industria');
        $this->db->where('status = 1');
        $this->db->where("nombre like '%".$texto."%'");
        $this->db->order_by("nombre");
        if ($pagina > 0){
            $this->db->limit(10, (($pagina - 1)*10));
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la cuenta de registros de la consulta
     */
    public function getCount($texto){
        $this->db->select('count(id) as total');
        $this->db->from('industria');
        $this->db->where('status = 1');
        $this->db->where("nombre like '%".$texto."%'");
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('industria', $data);
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('industria', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('industria',  array('status' => 0));
    }
 
}
//end model