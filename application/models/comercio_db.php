<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class comercio_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->from('comercio');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->from('comercio');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAllCatalogo(){
        $this->db->select('id,nombre');
        $this->db->from('comercio');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $pagina){
        $this->db->from('comercio');
        $this->db->where('status = 1');
        $this->db->where("(nombre like '%".$texto."%' OR servicios like '%".$texto."%')");
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
        $this->db->from('comercio');
        $this->db->where('status = 1');
        $this->db->where("(nombre like '%".$texto."%' OR servicios like '%".$texto."%')");
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('comercio', $data);
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('comercio', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('comercio',  array('status' => 0));
    }


    /***************** XREF INDUSTRIAS *****************/
 
    /**
     * Relacionar Industrias
     */
    public function insertIndustrias($data){
        $this->db->insert('xref_comercio_industria', $data);
    }

    /**
     * Relacionar Industrias
     */
    public function deleteIndustrias($data){
        $this->db->delete('xref_comercio_industria', $data);
    }

    /**
     * Obtiene las industrias relacionadas
     */
    public function getIndustrias($id){
        $this->db->select('industria.id, industria.nombre');
        $this->db->from('xref_comercio_industria');
        $this->db->join('industria', 'xref_comercio_industria.idIndustria = industria.id');
        $this->db->where('xref_comercio_industria.idComercio', $id);
        $this->db->where('industria.status = 1');
        return  $this->db->get()->result();
    }


}
//end model