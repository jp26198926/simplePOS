<?php
    
// Include the main    
    include("validate.php");
	include("config.php");
    
    if (!empty($_SESSION['inventory_sql']) || $_SESSION['inventory_sql']!=''){
        $sql = $_SESSION['inventory_sql'];

        $product = $_GET['product'] ? $_GET['product'] : "All";
        $ending_date = $_GET['ending'];
      
        
        $output='';
        $items='';

        $details = "<table>
                        <tr>
                            <td align=\"right\">Product Searched</td>
                            <td>: {$product}</td>
                            <td align=\"right\">Ending Date</td>
                            <td>: {$ending_date}</td>
                        </tr>
                    </table>";

        $signatory = "  <table>
                            <tr>
                                <td >Prepared By:</td>
                                <td>&nbsp;</td>
                                <td >Noted By:</td>
                                <td>&nbsp;</td>
                                <td >Audited By:</td>
                            </tr>
                            <tr>
                                <td align=\"center\"></td>
                                <td>&nbsp;</td>
                                <td align=\"center\"></td>
                                <td>&nbsp;</td>
                                <td align=\"center\"></td>
                            </tr>
                            <tr>
                                <td align=\"center\"></td>
                                <td>&nbsp;</td>
                                <td align=\"center\"></td>
                                <td>&nbsp;</td>
                                <td align=\"center\"></td>
                            </tr>
                            <tr>
                                <td><hr /></td>
                                <td>&nbsp;</td>
                                <td><hr /></td>
                                <td>&nbsp;</td>
                                <td><hr /></td>
                            </tr>
                            <tr>
                                <td align=\"center\">Name & Sign | Date</td>
                                <td>&nbsp;</td>
                                <td align=\"center\">Name & Sign | Date</td>
                                <td>&nbsp;</td>
                                <td align=\"center\">Name & Sign | Date</td>
                            </tr>
                        </table>";
                        
        $_SESSION['signatory']=$signatory;
        
        $tbl_list = "   <table cellspacing=\"0\" cellpadding=\"1\" border=\"1\" >
                            <tr align=\"center\" >                                
                                <th><b>Product Code</b></th>
                                <th><b>Product Name</b></th>                                    
                                <th><b>UOM</b></th>
                                <th><b>STOCK</b></th>                                 
                            </tr>
                            ";
                            
            include ('connect.php');
            
            $pop = $mysqli->query($sql);
            if ($pop){
                $count = $pop->num_rows;
                if ($count > 0){
                    while($row=$pop->fetch_object()){
                        $id = $row->id;
                        $code = $row->product_code;
                        $name = $row->product_name;
                       
                        $stock = floatval($row->stock);
                        $sale = floatval($row->sale);

                        $uom = $row->product_uom;               
                        $status_id = $row->status_id;
                        $status = $row->status;
                        
                        $current_balance = $stock - $sale;
                        
                        $tr_id = "tr_" . $id;                
                        
                        $tbl_list .= "<tr id='{$tr_id}'>";               
                        $tbl_list .= "   <td>{$code}</td>";
                        $tbl_list .= "   <td>{$name}</td>";
                        $tbl_list .= "   <td align=\"center\">{$uom}</td>";
                        $tbl_list .= "   <td align=\"center\">{$current_balance}</td>";
                                      
                        $tbl_list .= "</tr>";
                    }
                }else{
                    $tbl_list .= "<tr>";
                    $tbl_list .= "   <td colspan=\"6\" align=\"center\">No Record Found</td>";
                    $tbl_list .= "</tr>";
                }
            }else{
                $tbl_list .= "<tr><td colspan=\"8\">" . $mysqli->error . "</td></tr>";
            }
            
            $tbl_list .= "</table>";
            
            $mysqli->close();
            
            
            
    }else{
        echo "Error: Critical Error Encountered!";
        exit;
    }
    
         
    
   
               
    

//TCPDF library (search for installation path).
//require_once('/library/tcpdf/tcpdf.php');
require_once dirname(__FILE__) . '/library/tcpdf/tcpdf.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	
	public $logo_path="";
	public $company="";
	public $address="";
	public $page_name="";
	public $signatory="";

    //Page header
    public function Header() {
        // Logo
        //$image_file = 'images/png80.png';
		if ($this->logo_path){ //if value has been supplied then 
			$image_file = $this->logo_path;
			$this->Image($image_file, 15,4, 14,'', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		}		
		
        // Set font        
        $this->SetFont('helvetica', 'R', 12);  
		$this->MultiCell(100,10,$this->company,0,'L',false,0,30,6,false,0,false,true,0,'T',false);
        //$this->MultiCell(50,10,"Frabelle PNG Ltd.",0,'L',false,0,30,6,false,0,false,true,0,'T',false);
        
        $this->SetFont('helvetica', 'R', 8);     
		$this->MultiCell(50,10,$this->address,0,'L',false,0,30,8,false,0,false,true,0,'T',false);
        //$this->MultiCell(50,10,"Lae City, Papua New Guinea",0,'L',false,0,30,7,false,0,false,true,0,'T',false);
        
        $this->SetFont('helvetica', 'B', 15);   
		$this->Cell(0, 26, $this->page_name,0,1,'R', 0, '', 0, false, 'M', 'B');    
        //$this->Cell(0, 26, 'POS - PRODUCT SOLD',0,1,'R', 0, '', 0, false, 'M', 'B');        
        $this->writeHTML("<hr />",true,false,true,false,'');
    }

    // Page footer
    public function Footer() {
         // Position at 15 mm from bottom
        $this->SetY(-35);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $signatory=$_SESSION['signatory'];
        //$this->writeHTML($signatory,true,true);
		$this->writeHTML($this->signatory,true,true);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages() , 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        $preparedby = $_SESSION['ufullname'];
        //$rep = $_SESSION['rep'];        
        
    }    
    
}

// create new PDF document
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

$pdf->logo_path = $logo_path;
$pdf->company = $company;
$pdf->address = $address;
$pdf->page_name="POS - INVENTORY";
$pdf->signatory = $signatory;

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MIG PNG');
$pdf->SetTitle('POS');
$pdf->SetSubject('POST');
$pdf->SetKeywords('DOWNLOAD, PDF');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);
//$pdf->SetHeaderData('../../../ffcsystem/images/frabelle.jpg', 50, 'JOB ORDER GATEPASS', 'HELLO');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(true, 40);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 15);

// add a page
$pdf->AddPage('P','A4');


//$pdf->SetFont('helvetica', '', 11);

$pdf->SetFont('helvetica', '', 11);
$pdf->writeHTML($details,true,false,false,false,'');

// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTML($tbl_list, true, false, false, false, '');

//$pdf->Ln(2);

//$pdf->writeHTML($signatory,true,false,false,false,'');



$filename = "POS". date('Ymd His') . ".PDF";
//Close and output PDF document
$pdf->Output($filename, 'I');

//============================================================+
// END OF FILE
//============================================================+