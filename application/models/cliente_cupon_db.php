<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class cliente_cupon_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($key){
        $this->db->from('xref_cliente_cupon');
        $this->db->where('key', $key);
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('xref_cliente_cupon', $data);
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('key', $data['key']);
        $this->db->update('xref_cliente_cupon', $data);
    }
 
}
//end model