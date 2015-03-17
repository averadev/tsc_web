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
        $this->db->where('code', $key);
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
        $this->db->where('code', $data['key']);
        $this->db->update('xref_cliente_cupon', $data);
    }
	
	/**
     * Obtiene todos los registros activos del catalogo
     */
    public function cupones($idComercio){
		$this->db->select('url');
        $this->db->from('cupon');
        $this->db->where('idComercio', $idComercio);
        $this->db->where('status', 1);
		$this->db->where('fechaInicio <= CURDATE()');
		$this->db->where('fechaFin >= CURDATE()');
        return  $this->db->get()->result();
    }
	
	/**
     * Obtiene todos los registros activos del catalogo
     */
    public function totales($idComercio){
		$query = '(select count(*) from cupon where fechaInicio <= CURDATE() and fechaFin >= CURDATE() and idComercio = '.$idComercio.' and status = 1) as activos, '.
			'(select count(*) from cupon  '.
			'join xref_cliente_cupon on cupon.id = xref_cliente_cupon.idCupon '.
			'where idComercio = '.$idComercio.' and xref_cliente_cupon.status = 1) as circulacion, '.
			'(select count(*) from cupon  '.
			'join xref_cliente_cupon on cupon.id = xref_cliente_cupon.idCupon '.
			'where idComercio = '.$idComercio.' and xref_cliente_cupon.status = 2) as redimidos, '.
			'(select sum(likes) from cupon where idComercio = '.$idComercio.' and status = 1) as likes';
		$this->db->select($query, true);
        $this->db->from('comercio');
        $this->db->where('id', $idComercio);
        return  $this->db->get()->result();
    }
 
}
//end model