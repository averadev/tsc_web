<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class cupon_db extends CI_MODEL
{
 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function get($id){
        $this->db->select('*,'.
        '(select group_concat(xref.idTipoCupon) from xref_cupon_tipo xref '.
        ' where xref.idCupon = cupon.id) as tipos ');
        $this->db->from('cupon');
        $this->db->where('id', $id);
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene todos los registros activos del catalogo
     */
    public function getAll(){
        $this->db->from('cupon');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la busqueda de los registros activos del catalogo
     */
    public function getSearch($texto, $pagina){
		$this->db->select('cupon.id, cupon.url, cupon.fechaInicio, cupon.fechaFin, cupon.descripcion, comercio.nombre as comercio,'.
			'(select group_concat(tc.nombre) from xref_cupon_tipo xref '.
			' join tipocupon tc on xref.idTipoCupon = tc.id '.
			' where xref.idCupon = cupon.id) as tipos ');
		$this->db->from('cupon');
		$this->db->join('comercio', 'cupon.idComercio = comercio.id ');
		$this->db->where('cupon.status = 1 ');
        $this->db->where("(cupon.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        $this->db->order_by("cupon.id", "asc");
        if ($pagina > 0){
            $this->db->limit(10, (($pagina - 1)*10));
        }
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene la cuenta de registros de la consulta
     */
    public function getCount($texto){
        $this->db->select('count(cupon.id) as total');
		$this->db->from('cupon');
		$this->db->join('comercio', 'cupon.idComercio = comercio.id ');
		$this->db->where('cupon.status = 1 ');
        $this->db->where("(cupon.descripcion like '%".$texto."%' OR comercio.nombre like '%".$texto."%')");
        return  $this->db->get()->result();
    }
 
    /**
     * Guarda el registro
     */
    public function insert($data){
        $this->db->insert('cupon', $data);
        return $this->db->insert_id();
    }
 
    /**
     * Actualiza el registro
     */
    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('cupon', $data);
    }
 
    /**
     * Eliminar el registro
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->update('cupon',  array('status' => 0));
    }

    /************************** RELACION: CUPON - TIPO **************************/
 
    /**
     * Guarda el registro
     */
    public function insertTipo($data){
        $this->db->insert('xref_cupon_tipo', $data);
    }

    /**
     * Relacionar Industrias
     */
    public function deleteTipo($data){
        $this->db->delete('xref_cupon_tipo', $data);
    }


    /*************************** CONSULTA DE CUPONES ***************************/
 
 	/**
	 * Obtiene los cupones por tipo
	 */
    public function getCupon($id){
    	$this->db->select('cupon.paginaAsociada, cupon.url, cupon.idTipoCupon, comercio.nombre, comercio.servicios');
		$this->db->from('cupon');
		$this->db->join('comercio', 'cupon.idComercio = comercio.id');
		$this->db->where('cupon.id =', $id);
		$this->db->where('cupon.status = 1');
		$this->db->where('cupon.fechaInicio <= CURDATE()');
		$this->db->where('cupon.fechaFin >= CURDATE()');

    	return  $this->db->get()->result();
    }
 
 	/**
	 * Obtiene los cupones por tipo
	 */
    public function getCuponesPorTipo($tipo){
    	$this->db->select('cupon.id, cupon.url, cupon.descripcion, cupon.likes, comercio.id, comercio.site, comercio.nombre, comercio.direccion, comercio.servicios');
		$this->db->from('cupon');
		$this->db->join('comercio', 'cupon.idComercio = comercio.id');
                $this->db->join('xref_cupon_tipo', 'cupon.id = xref_cupon_tipo.idCupon');
		// $this->db->where('cupon.idTipoCupon =', $tipo);
		$this->db->where('cupon.status = 1');
		$this->db->where('cupon.fechaInicio <= CURDATE()');
		$this->db->where('cupon.fechaFin >= CURDATE()');
                $this->db->where('xref_cupon_tipo.idTipoCupon =',$tipo);

    	return  $this->db->get()->result();
    }
 
 	/**
	 * Obtiene los cupones por industria 
	 */
    public function getCuponesPorIndustria($industria){
    	$this->db->select('cupon.id, cupon.url, cupon.descripcion, cupon.likes, comercio.id, comercio.site, comercio.nombre, comercio.direccion, comercio.servicios');
		$this->db->from('cupon');
		$this->db->join('comercio', 'cupon.idComercio = comercio.id');
		$this->db->join('xref_comercio_industria', 'comercio.id = xref_comercio_industria.idComercio');
		$this->db->where('xref_comercio_industria.idIndustria =', $industria);
		$this->db->where('cupon.status = 1');
		$this->db->where('cupon.fechaInicio <= CURDATE()');
		$this->db->where('cupon.fechaFin >= CURDATE()');

    	return  $this->db->get()->result();
    }
 
 	/**
	 * Obtiene los cupones por texto 
	 */
    public function getCuponesPorTexto($texts){
    	$this->db->select('cupon.id, cupon.url, cupon.descripcion, cupon.likes, comercio.id, comercio.site, comercio.nombre, comercio.direccion, comercio.servicios');
		$this->db->from('cupon');
		$this->db->join('comercio', 'cupon.idComercio = comercio.id');
		// Build where statement
		$where = "cupon.status = 1 AND cupon.fechaInicio <= CURDATE() AND cupon.fechaFin >= CURDATE()";
		foreach ($texts as $text){
			$where =  $where." AND (comercio.nombre like '%".$text."%' OR comercio.servicios like '%".$text."%')";
  		}
  		$this->db->where($where);

    	return  $this->db->get()->result();
    }
    public function getCuponesPorComercio($id_comercio){
    	$this->db->select('*');
		$this->db->from('cupon');
		$this->db->where('idComercio =', $id_comercio);
		$this->db->where('status = 1');
		$this->db->where('fechaInicio <= CURDATE()');
		$this->db->where('fechaFin >= CURDATE()');

    	return  $this->db->get()->result();
    }
    public function setLikeCoupon($coupon){
        $this->db->where('id', $coupon->id);
        $this->db->update('cupon',  array('likes' => $coupon->likes + 1));
    }
    

    /***************** DASHBOARD *****************/
    
    
    /**
     * Obtiene cupones por comercio
     */
    public function cuponesComercio(){
        $this->db->select('nombre, (select count(*) from cupon where cupon.idComercio = comercio.id) as total');
        $this->db->from('comercio');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
 
    /**
     * Obtiene cupones por industria
     */
    public function cuponesIndustria(){
        $this->db->select('nombre, (select count(*) from cupon left join xref_comercio_industria on cupon.idComercio = xref_comercio_industria.idComercio where industria.id = xref_comercio_industria.idIndustria) as total');
        $this->db->from('industria');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
    
    /**
     * Obtiene cupones por tipo
     */
    public function cuponesTipo(){
        $this->db->select('nombre, (select count(*) from xref_cupon_tipo where tipocupon.id = xref_cupon_tipo.idTipoCupon) as total');
        $this->db->from('tipocupon');
        $this->db->where('status = 1');
        return  $this->db->get()->result();
    }
 
}
//end model