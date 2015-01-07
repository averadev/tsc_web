<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuponera extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('tipocupon_db');
        $this->load->model('cliente_db');
    }

    public function index(){
        $this->load->view('vwCliente');
    }
    
    public function t($i){
        $cupon = $this->tipocupon_db->get($i)[0];
        $data['id'] = $cupon->id;
        $data['nombre'] = $cupon->nombre;
        $data['costo'] = $cupon->costo;
        $this->load->view('vwCliente',$data);
    }    
    
    /**
     * Guarda el registro
     */
    public function save(){
        if($this->input->is_ajax_request()){
            $clientExist = $this->cliente_db->get($_POST["correo"]);
            
            
            if (count($clientExist) > 0){
                echo json_encode(array("error" => 1, "mensaje" => "El email ya se encuentra registrado."));
            }else{
                $key = md5($_POST['idTipoCupon'].$_POST["correo"]); 
                $cliente = $this->cliente_db->insert($_POST);
                $this->registro($cliente->correo, $_POST["correo"]);
                $this->cliente_db->insertXrefClienteCupon($cliente->id, $_POST['idTipoCupon'], $key);
                echo json_encode(array("error" => 0, "key" => $cliente->password));    
            }
        }
    }   
    
    /**
     * Guarda el registro
     */
    public function save2(){
        if($this->input->is_ajax_request()){
            $clientExist = $this->cliente_db->getPass($_POST["correo"], md5($_POST["password"]));
            if (count($clientExist) > 0){
                $tipoExist = $this->cliente_db->getXrefClienteCupon($clientExist[0]->id, $_POST['idTipoCupon']);
                $key = md5($_POST['idTipoCupon'].$_POST["correo"]); 
                if (count($tipoExist) > 0){
                    if ($tipoExist[0]->status == 1){
                        echo json_encode(array("error" => 1, "mensaje" => "El tipo de cuponera ya esta ligada a su cuenta."));   
                        return;
                    }
                }else{
                    $this->cliente_db->insertXrefClienteCupon($clientExist[0]->id, $_POST['idTipoCupon'], $key);
                }
                echo json_encode(array("error" => 0, "key" => $key));    
                
            }else{
                echo json_encode(array("error" => 1, "mensaje" => "El email y/o password son incorrectos."));
            }
        }
    }
    
    /**
     * Pago registrado
     */
    public function success(){
        $this->load->view('vwCompra');
    }
    
    /**
     * Pago registrado
     */
    public function pay($key){
        $cliente = $this->cliente_db->payXrefClienteCupon($key);
        $this->pago($cliente->correo, $cliente->nombre);
    }
        
    function registro($email, $password){
    	
        // mensaje
        $mensaje = '
        <html>
            <body>
                <div style="width:100%; height:5px; background: #f79c43;"></div>
                <div style="width:100%; height:20px; background: #000; font-size:20px; color:#ffffff; padding: 10px 0 10px 50px; ">
                    Registro en The Saving Coupon
                </div>

                <br/><br/>
                <div style="width:100%; margin: 20px 0;">
                    <h3>El registro fue satisfactorio.</h3>

                    <p style="font-family:Georgia; font-size:18px;">Correo: '.$email.'</p>
                    <p style="font-family:Georgia; font-size:18px;">Password: '.$password.'</p>

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
        mail($email, "Registro The Saving Coupon", $mensaje, $cabeceras);
    }
        
    function pago($email, $tipo){
    	
        // mensaje
        $mensaje = '
        <html>
            <body>
                <div style="width:100%; height:5px; background: #f79c43;"></div>
                <div style="width:100%; height:20px; background: #000; font-size:20px; color:#ffffff; padding: 10px 0 10px 50px; ">
                    Pago de Cuponera
                </div>

                <br/><br/>
                <div style="width:100%; margin: 20px 0;">
                    <p style="font-family:Georgia; font-size:18px;">Se ha registrado su compra por concepto de la cuponera '.$tipo.'.</p>
                    <p style="font-family:Georgia; font-size:18px;">Ahora puede hacer uso de los cupones y descuentos mediante las aplicaciones moviles.</p>

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
        mail($email, "Pago de Cuponera ".$tipo, $mensaje, $cabeceras);
    }
    
    
}



