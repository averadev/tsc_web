<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('fpdf/fpdf.php');
class Createfile extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->database('default');
        $this->load->model('api_db');
    }
	
	
    public function index(){
		
    }
	
	public function bykey($key){
		$usuario = $this->api_db->getUserPay($key);
		if (count($usuario) > 0){
			$idCliente = $usuario[0]->idCliente;
			$type = $usuario[0]->idTipoCupon;
			$cupones = $this->api_db->getCupones($idCliente, $type);
			
			$this->makePDF($cupones);
		}else{
			
		}
    }
	
	private function makePDF($data){
		
		$header = array('', '');
		
		$pdf=new FPDF();
		//Primera página
		$pdf->AddPage();
		
		// Colores, ancho de línea y fuente en negrita
		$pdf->SetFillColor(255,0,0);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(100,100,100);
		$pdf->SetLineWidth(.3);
		
		// Cabecera
		$pdf->SetFont('Helvetica','B',25);
		$pdf->Image( base_url().IMG . 'app/logo-Xmin.png', 15, 8);
		$pdf->Cell(10,10,'         The Saving Coupon');
		$pdf->Ln();
		
		$w = array(90, 90);
		$pdf->SetFont('helvetica','', 12);
		for($i=0;$i<count($header);$i++)
			$pdf->Cell($w[$i],1,$header[$i],1,0,'C',true);
		$pdf->Ln();
		
		// Restauración de colores y fuentes
		$pdf->SetFillColor(255, 246, 229);
		$pdf->SetFont('');
		
		// Datos
		$fill = false;
		$rowCount = 1;
		$realRow = 0;
		foreach($data as $row){
			if ($rowCount % 2 == 1){
				$pdf->Cell(90,54,' ','LR',0,'C',$fill);
				$pdf->Cell(90,54,' ','LR',0,'C',$fill);
				$pdf->Image( base_url().IMG . 'coupon/' . $row->url, 15, ($realRow * 62) + 23);
				$pdf->Ln();
				$pdf->Cell($w[0],8,"Code: " . $row->code,'LR',0,'C',$fill);
				
				if (count($data) == $rowCount){
					$pdf->Ln();
					$fill = !$fill;
				}
				//$pdf->Image( base_url().IMG . 'coupon/13-4342899313.png' , 15, ($rowCount*63) + 23);
			}else{
				$pdf->Cell($w[1],8,"Code: " . $row->code,'LR',0,'C',$fill);
				$pdf->Image( base_url().IMG . 'coupon/' . $row->url, 105, ($realRow * 62) + 23);
				$realRow++;
				$pdf->Ln();
				$fill = !$fill;
			}
			
			if ($rowCount == 8){
				$realRow = 0;
				$rowCount = 1;
				
				$pdf->Cell(array_sum($w),0,'','T');
				$pdf->AddPage();
				$pdf->SetFont('Helvetica','B',25);
				$pdf->Image( base_url().IMG . 'app/logo-Xmin.png', 15, 8);
				$pdf->Cell(10,10,'         The Saving Coupon');
				$pdf->SetFont('helvetica','', 12);
				$pdf->Ln();
				
				$pdf->SetFillColor(255,0,0);
				for($i=0;$i<count($header);$i++)
					$pdf->Cell($w[$i],1,$header[$i],1,0,'C',true);
				$pdf->SetFillColor(224,235,255);
				$pdf->Ln();
			}else{
				$rowCount++;
			}
		}
		
		// Línea de cierre
		if ($rowCount % 2 == 0){
			$pdf->Cell($w[1],8,'','LR',0,'C',$fill);
			$pdf->Ln();
		}
		$pdf->Cell(array_sum($w),0,'','T');

		$pdf->Output();
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
