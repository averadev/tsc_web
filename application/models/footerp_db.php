<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class footerp_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->from('footer');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->select('footer.id, footer.url, footer.descripcion, footer.paginaAsociada, comercio.nombre as comercio');
        $this->db->from('footer');
        $this->db->join('comercio', 'footer.idComercio = comercio.id ');
        $this->db->where('footer.status = 1');
        $this->db->order_by('footer.id');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $pagina){
        $this->db->select('footer.id, footer.url, footer.descripcion, comercio.nombre as comercio');
        $this->db->from('banner');
        $this->db->join('comercio', 'footer.idComercio = comercio.id ');
        $this->db->where('footer.status = 1 ');
        $this->db->where("(footer.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        $this->db->order_by("footer.id", "asc");
        if ($pagina > 0){
            $this->db->limit(10, (($pagina - 1)*10));
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la cuenta de registros de la consulta
     */
    public function getCount($texto){
        $this->db->select('count(footer.id) as total');
        $this->db->from('footer');
        $this->db->join('comercio', 'footer.idComercio = comercio.id ');
        $this->db->where('footer.status = 1 ');
        $this->db->where("(footer.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('footer', $data);
        return $this->db->insert_id();
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('footer', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('footer',  array('status' => 0));
    }
 
}
//end model