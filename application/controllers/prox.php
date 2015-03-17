<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class prox extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

    public function index(){
        $this->load->view('vwProx');
    }
	
	public function sendMail(){
    	
        // mensaje
		$email = $_POST['email'];
        $mensaje = '
        <html>
            <body>
                <div style="width:100%; height:5px; background: #f79c43;"></div>
                <div style="width:100%; height:20px; background: #000; font-size:20px; color:#ffffff; padding: 10px 0 10px 50px; ">
                    Solicitud de informacion
                </div>

                <br/><br/>
                <div style="width:100%; margin: 20px 0;">
                    <h3>Solicitud de informacion desde la pagina de Proximamente.</h3>

                    <p style="font-family:Georgia; font-size:18px;">Correo: '.$email.'</p>

                </div>
                <br/><br/><br/><br/>

                <div style="width:100%; height:30px; background: #000; font-size:18px; font-weight: bold; color:#ffffff;"></div>
                <div style="width:100%; height:5px; background: #f79c43;"></div>

            </body>
        </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: Contacto <contacto@thesavingcoupon.com>';

        // Enviarlo
        mail('contacto@thesavingcoupon.com', "Solicitud de informacion", $mensaje, $cabeceras);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
