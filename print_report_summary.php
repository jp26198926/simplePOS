<?php

// Include the main    
include("validate.php");
include("config.php");

if (!empty($_SESSION['sales_sql_summary']) || $_SESSION['sales_sql_summary'] != '') {

    $sql = $_SESSION['sales_sql_summary'];
    $search_product = $_SESSION['sales_product_summary'];

    $search_dtfrom = $_SESSION['sales_dtfrom_summary'];
    $search_dtto = $_SESSION['sales_dtto_summary'];

    $details = "   <table>
                            <tr>
                                <td>Search Product: {$search_product}</td>
                                <td>Date Range: {$search_dtfrom} to {$search_dtto}</td>
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

    $_SESSION['signatory'] = $signatory;

    $tbl_list = "   <table cellspacing=\"0\" cellpadding=\"1\"  border=\"1\" >
                            <tr align=\"center\" >                                
                                <th rowspan=\"2\"  width=\"15%\" align=\"center\" ><b>PRODUCT CODE</b></th>
                                <th rowspan=\"2\" width=\"20%\" align=\"center\" ><b>PRODUCT NAME</b></th>
                                <th rowspan=\"2\" width=\"5%\" align=\"center\" ><b>UOM</b></th>
                                <th colspan=\"2\" width=\"10%\" align=\"center\" ><b>INSIDER</b></th>
                                <th colspan=\"2\" width=\"10%\" align=\"center\" ><b>OUTSIDER</b></th>
                                <th colspan=\"2\" width=\"10%\" align=\"center\" ><b>KITCHEN</b></th>                                
                                <th colspan=\"2\" width=\"10%\" align=\"center\" ><b>SALE</b></th>
                                <th colspan=\"2\" width=\"20%\" align=\"center\" ><b>OVERALL</b></th>                                                              
                            </tr>
                            <tr>
                                <th  width=\"4%\" align=\"center\" ><b>QTY</b></th>
                                <th  width=\"6%\" align=\"center\" ><b>TOTAL</b></th>
                                
                                <th  width=\"4%\" align=\"center\" ><b>QTY</b></th>
                                <th  width=\"6%\" align=\"center\" ><b>TOTAL</b></th>
                                
                                <th  width=\"4%\"  align=\"center\" ><b>QTY</b></th>
                                <th  width=\"6%\" align=\"center\" ><b>TOTAL</b></th>

                                <th  width=\"4%\"  align=\"center\" ><b>QTY</b></th>
                                <th  width=\"6%\" align=\"center\" ><b>TOTAL</b></th>
                                
                                <th  width=\"7%\" align=\"center\" ><b>QTY</b></th>
                                <th  width=\"13%\" align=\"center\" ><b>TOTAL</b></th>
                            </tr>
                            ";

    include('connect.php');

    $pop = $mysqli->query($sql);
    if ($pop) {
        $count = $pop->num_rows;
        if ($count > 0) {

            $total_qty = 0;
            $total_total = 0;

            $total_qty_i = 0;
            $total_total_i = 0;

            $total_qty_o = 0;
            $total_total_o = 0;

            $total_qty_k = 0;
            $total_total_k = 0;

            $total_qty_s = 0;
            $total_total_s = 0;

            while ($row = $pop->fetch_object()) {
                $product_code = $row->product_code;
                $product_name = $row->product_name;
                $uom = $row->uom;

                $qty = floatval($row->qty) > 0.01 ? number_format(floatval($row->qty), 2, '.', ',') : "";
                $qty_insider = floatval($row->qty_insider) > 0.01 ? number_format(floatval($row->qty_insider), 2, '.', ',') : "";
                $qty_outsider = floatval($row->qty_outsider) > 0.01 ? number_format(floatval($row->qty_outsider), 2, '.', ',') : "";
                $qty_kitchen = floatval($row->qty_kitchen) > 0.01 ? number_format(floatval($row->qty_kitchen), 2, '.', ',') : "";
                $qty_sale = floatval($row->qty_sale) > 0.01 ? number_format(floatval($row->qty_sale), 2, '.', ',') : "";


                $discount_total = number_format(floatval($row->discount_total), 2, '.', ',');

                $total = floatval($row->total) > 0.01 ? number_format(floatval($row->total), 2, '.', ',') : "";
                $total_insider = floatval($row->total_insider) > 0.01 ? number_format(floatval($row->total_insider), 2, '.', ',') : "";
                $total_outsider = floatval($row->total_outsider) > 0.01 ? number_format(floatval($row->total_outsider), 2, '.', ',') : "";
                $total_kitchen = floatval($row->total_kitchen) > 0.01 ? number_format(floatval($row->total_kitchen), 2, '.', ',') : "";
                $total_sale = floatval($row->total_sale) > 0.01 ? number_format(floatval($row->total_sale), 2, '.', ',') : "";

                $total_qty += floatval($row->qty);
                $total_total += floatval($row->total);

                $total_qty_i += floatval($row->qty_insider);
                $total_total_i += floatval($row->total_insider);

                $total_qty_o += floatval($row->qty_outsider);
                $total_total_o += floatval($row->total_outsider);

                $total_qty_k += floatval($row->qty_kitchen);
                $total_total_k += floatval($row->total_kitchen);

                $total_qty_s += floatval($row->qty_sale);
                $total_total_s += floatval($row->total_sale);

                $tbl_list .=  "<tr align=\"center\" >";
                $tbl_list .=  "  <td>" . $product_code . "</td>";
                $tbl_list .=  "  <td>" . $product_name . "</td>";
                $tbl_list .=  "  <td align=\"center\" >" . $uom . "</td>";

                $tbl_list .=  "<td align=\"right\">" . $qty_insider . "</td>";
                $tbl_list .=  "<td align=\"right\">" . $total_insider . "</td>";

                $tbl_list .=  "<td align=\"right\">" . $qty_outsider . "</td>";
                $tbl_list .=  "<td align=\"right\">" . $total_outsider . "</td>";

                $tbl_list .=  "<td align=\"right\">" . $qty_kitchen . "</td>";
                $tbl_list .=  "<td align=\"right\">" . $total_kitchen . "</td>";

                $tbl_list .=  "<td align=\"right\">" . $qty_sale . "</td>";
                $tbl_list .=  "<td align=\"right\">" . $total_sale . "</td>";

                $tbl_list .=  "<td align=\"right\" >" . $qty . "</td>";
                $tbl_list .=  "<td align=\"right\" >" . $total . "</td>";

                $tbl_list .=  "</tr>";
            }

            $tbl_list .=  "<tr>";
            $tbl_list .=  "     <td colspan=\"3\"><b>GRAND TOTAL</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_qty_i, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_total_i, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_qty_o, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_total_o, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_qty_k, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_total_k, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_qty_s, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_total_s, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_qty, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "     <td align=\"right\"><b>" . number_format($total_total, 2, '.', ',') . "</b></td>";
            $tbl_list .=  "</tr>";
        } else {
            $tbl_list .= "<tr><td colspan=\"13\">No Record</td></tr>";
        }
    } else {
        $tbl_list .= "<tr><td colspan=\"13\">" . $mysqli->error . "</td></tr>";
    }



    $tbl_list .= "</table>";

    $mysqli->close();
} else {
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
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

$pdf->logo_path = $logo_path;
$pdf->company = $company;
$pdf->address = $address;
$pdf->page_name="POS - PRODUCT SOLD";
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
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 15);

// add a page
$pdf->AddPage('L', 'A4');


$pdf->SetFont('helvetica', '', 11);


$pdf->writeHTML($details, true, false, false, false, '');

// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTML($tbl_list, true, false, false, false, '');

//$pdf->Ln(2);

//$pdf->writeHTML($signatory,true,false,false,false,'');



$filename = "POS" . date('Ymd His') . ".PDF";
//Close and output PDF document
$pdf->Output($filename, 'I');

//============================================================+
// END OF FILE
//============================================================+