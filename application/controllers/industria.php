<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class industria extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('industria_db');
    }

	public function index(){
		$this->load->view('main');
	}

	/**
	 * Obtiene las industrias
	 */
	public function getAllIndustria(){
		if($this->input->is_ajax_request()){
			$data = $this->industria_db->getAllIndustria();
            echo json_encode($data);
        }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */