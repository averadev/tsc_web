<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class api_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene el tipo de usuario
     */
    public function getUserType($id){
        $this->db->from('xref_cliente_tipo_cupon');
        $this->db->where('idCliente', $id);
        return  $this->db->get()->result();
    }
	
	/**
     * Obtiene el tipo de usuario
     */
    public function getUserPay($key){
        $this->db->from('xref_cliente_tipo_cupon');
        $this->db->where('key', $key);
        return  $this->db->get()->result();
    }
	
	/**
     * Obtiene todos los registros activos del catalogo
     */
    public function verifyEmailPass($email, $pass){
        $this->db->from('cliente');
        $this->db->where('correo', $email);
        $this->db->where('password', $pass);
        return $this->db->get()->result();
    }
	
	/**
     * Obtiene todos los registros activos del catalogo
     */
    public function verifyPay($idCliente){
        $this->db->from('xref_cliente_tipo_cupon');
        $this->db->where('idCliente', $idCliente);
		$this->db->where('status', 2);
		$this->db->order_by('idTipoCupon',"desc"); 
		
        return $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getCupones($idCliente, $type){
        $this->db->select('cupon.id, cupon.url, cupon.descripcion, fechaInicio, fechaFin, idComercio, terminosCondiciones');
        $this->db->select('xref_cliente_cupon.code, xref_cliente_cupon.status as redimido');
        $this->db->from('cupon');
        $this->db->join('xref_cupon_tipo', 'cupon.id = xref_cupon_tipo.idCupon');
        $this->db->join('xref_cliente_cupon', 'cupon.id = xref_cliente_cupon.idCupon and idCliente = '.$idCliente, 'left' );
        $this->db->where('cupon.status = 1');
        $this->db->where('cupon.fechaFin >= curdate()');
		if ($type == "1" || $type == 1) {
        	$this->db->where('xref_cupon_tipo.idTipoCupon =', $type);
		}else if ($type == "2" || $type == 2) {
			$this->db->where('xref_cupon_tipo.idTipoCupon in (1, 2)');
		}
        $this->db->group_by('cupon.id'); 
        $this->db->order_by("cupon.id");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getComercios($type){
        $this->db->select('comercio.id, comercio.nombre, comercio.direccion, comercio.servicios');
        $this->db->select('comercio.telefono, comercio.direccion, comercio.latitud, comercio.longitud');
        $this->db->from('comercio');
        $this->db->where('comercio.status = 1');
        $this->db->order_by("comercio.id");
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getXrefComerCat($type){
        $this->db->select('xref_comercio_industria.idComercio, xref_comercio_industria.idIndustria');
        $this->db->from('cupon');
        $this->db->join('xref_cupon_tipo', 'cupon.id = xref_cupon_tipo.idCupon');
        $this->db->join('comercio', 'cupon.idComercio = comercio.id');
        $this->db->join('xref_comercio_industria', 'comercio.id = xref_comercio_industria.idComercio');
        $this->db->where('cupon.status = 1');
        $this->db->where('cupon.fechaFin >= curdate()');
		if ($type == "1" || $type == 1) {
        	$this->db->where('xref_cupon_tipo.idTipoCupon =', $type);
		}else if ($type == "2" || $type == 2) {
			$this->db->where('xref_cupon_tipo.idTipoCupon in (1, 2)');
		}
        $this->db->group_by(array("xref_comercio_industria.idComercio", "xref_comercio_industria.idIndustria")); 
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getCategories($type){
        $this->db->select('industria.id, industria.nombre');
        $this->db->from('cupon');
        $this->db->join('xref_cupon_tipo', 'cupon.id = xref_cupon_tipo.idCupon');
        $this->db->join('comercio', 'cupon.idComercio = comercio.id');
        $this->db->join('xref_comercio_industria', 'comercio.id = xref_comercio_industria.idComercio');
        $this->db->join('industria', 'xref_comercio_industria.idIndustria = industria.id');
        $this->db->where('cupon.status = 1');
        $this->db->where('cupon.fechaFin >= curdate()');
		if ($type == "1" || $type == 1) {
        	$this->db->where('xref_cupon_tipo.idTipoCupon =', $type);
		}else if ($type == "2" || $type == 2) {
			$this->db->where('xref_cupon_tipo.idTipoCupon in (1, 2)');
		}
        $this->db->group_by('industria.id'); 
        $this->db->order_by("industria.id");
        return  $this->db->get()->result();
    }
 
}
//end model