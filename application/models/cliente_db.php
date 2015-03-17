<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class cliente_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($correo){
        $this->db->from('cliente');
        $this->db->where('correo', $correo);
        return  $this->db->get()->result();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getPass($correo, $password){
        $this->db->from('cliente');
        $this->db->where('correo', $correo);
        $this->db->where('password', $password);
        return  $this->db->get()->result();
    }
    
    /**
     * Guarda el registro
     */
    public function insert($data){
        $cliente = array(
            "correo" => $data["correo"],
            "password" => md5($data["password"]),
			"nombre" => $data["nombre"],
			"pais" => $data["pais"],
			"estancia" => $data["estancia"],
            "status" => 1
        );
        $this->db->insert('cliente', $cliente);
        
        $this->db->from('cliente');
        $this->db->where('correo', $data["correo"]);
        return $this->db->get()->first_row();
    }
    
    public function getXrefClienteCupon($cliente_id, $cupon_id){
        $data = array(
            'idCliente' => $cliente_id,
            'idTipoCupon' => $cupon_id,
        );
        
        $this->db->from('xref_cliente_tipo_cupon');
        $this->db->where($data);
        return  $this->db->get()->result();
    }
    
    public function insertXrefClienteCupon($cliente_id, $cupon_id, $key){
        $data = array(
            'idCliente' => $cliente_id,
            'idTipoCupon' => $cupon_id,
            'key' => $key,
            'status' => 0
        );
        $this->db->insert('xref_cliente_tipo_cupon', $data);
    }
    
    public function payXrefClienteCupon($key){
        $this->db->where('key', $key);
        $this->db->update('xref_cliente_tipo_cupon', array('status' => 1));
        
        $this->db->select('cliente.correo, tipocupon.nombre');
        $this->db->from('cliente');
        $this->db->join('xref_cliente_tipo_cupon', 'cliente.id = xref_cliente_tipo_cupon.idCliente ');
        $this->db->join('tipocupon', 'xref_cliente_tipo_cupon.idTipoCupon = tipocupon.id ');
        $this->db->where('xref_cliente_tipo_cupon.key', $key);
        return $this->db->get()->first_row();
    }
 
}
//end model