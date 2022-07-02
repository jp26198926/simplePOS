<?php

// Include the main    
include("validate.php");
include("config.php");

if (!empty($_SESSION['inventory_sql']) || $_SESSION['inventory_sql'] != '') {

    /* GET ACTIVE BUYER TYPES */
    include('connect.php');
    $buyer_list = array();
    $sql = "SELECT id, type FROM pos_buyer WHERE status_id=1 ORDER BY type;";
    $pop = $mysqli->query($sql);
    
    if ($pop) {
        while ($row = $pop->fetch_object()) {
            $buyer_type = strtoupper($row->type . '');
            array_push($buyer_list, $buyer_type);
        }
    }

    $mysqli->close();
    $buyer_count = count($buyer_list);
    $column_count = $buyer_count + 6;

    /* GET SEARCHED SESSION */
    $sql = $_SESSION['inventory_sql'];

    $product = $_GET['product'] ? $_GET['product'] : "All";
    $ending_date = $_GET['ending'];


    $output = '';
    $items = '';

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

    $_SESSION['signatory'] = $signatory;

    $tbl_list = "   <table cellspacing=\"0\" cellpadding=\"2\" border=\"1\" >
                        <thead>    
                            <tr align=\"center\" >                                
                                <th rowspan=\"2\"><b>CODE</b></th>
                                <th rowspan=\"2\"><b>PRODUCT</b></th>                                    
                                <th rowspan=\"2\"><b>UOM</b></th>
                                <th rowspan=\"2\"><b>CATEGORY</b></th>
                                <th rowspan=\"2\"><b>STOCK</b></th> 
                                <th rowspan=\"2\"><b>SUPPLIER PRICE</b></th> 
                                <th colspan=\"{$buyer_count}\"><b>SELLING PRICE</b></th>                               
                            </tr>
                            <tr>";
    foreach ($buyer_list as $buyer){
       $tbl_list .= "           <th><b>" . $buyer . "</b></th>";
    }

    $tbl_list .= "           </tr>
                        </thead>";

    include('connect.php');

    $pop = $mysqli->query($sql);
    if ($pop) {
        $count = $pop->num_rows;
        if ($count > 0) {
            while ($row = $pop->fetch_object()) {
                $id = $row->id;
                $code = $row->product_code;
                $name = $row->product_name;

                $stock = floatval($row->stock);
                $sale = floatval($row->sale);

                $uom = $row->product_uom;
                $category = $row->category;
                $status_id = $row->status_id;
                $status = $row->status;

                $current_balance = $stock - $sale;

                $supplier_price = $row->supplier_price;

                $tr_id = "tr_" . $id;

                $tbl_list .= "<tr id='{$tr_id}'>";
                $tbl_list .= "   <td>{$code}</td>";
                $tbl_list .= "   <td>{$name}</td>";
                $tbl_list .= "   <td align=\"center\">{$uom}</td>";
                $tbl_list .= "   <td align=\"center\">{$category}</td>";
                $tbl_list .= "   <td align=\"center\">{$current_balance}</td>";
                $tbl_list .= "   <td align=\"right\">{$supplier_price}</td>";

                //get all prices from active buyer type
                $price_sql = "SELECT pp.price as price
                            FROM pos_price pp
                            LEFT JOIN pos_buyer pb ON pb.id = pp.buyer_id AND pb.status_id = 1
                            WHERE pp.product_id={$id} AND pb.status_id=1
                            ORDER BY pb.type;";
                                                            
                $price_pop = $mysqli->query($price_sql);
                
                if ($price_pop){
                    $price_count = $price_pop->num_rows;
                    
                    if ($price_count > 0){
                        while($price_row = $price_pop->fetch_object()){  
                            $price_price = number_format($price_row->price,2,'.',',');
                                                        
                            $tbl_list .= "<td align=\"right\">{$price_price}</td>";
                        }                            
                    }else{                    
                        $tbl_list .= "<td colspan=\"{$buyer_count}\" align=\"center\">No Price Yet</td>";
                    }
                }else{
                    $tbl_list .=  "<td colspan=\"{$buyer_count}\" align=\"center\">Error</td>";
                }

                $tbl_list .= "</tr>";
            }
        } else {
            $tbl_list .= "<tr>";
            $tbl_list .= "   <td colspan=\"{$column_count}\" align=\"center\">No Record Found</td>";
            $tbl_list .= "</tr>";
        }
    } else {
        $tbl_list .= "<tr><td colspan=\"{$column_count}\">" . $mysqli->error . "</td></tr>";
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
class MYPDF extends TCPDF
{

    public $logo_path = "";
    public $company = "";
    public $address = "";
    public $page_name = "";
    public $signatory = "";

    //Page header
    public function Header()
    {
        // Logo
        //$image_file = 'images/png80.png';
        if ($this->logo_path) { //if value has been supplied then 
            $image_file = $this->logo_path;
            $this->Image($image_file, 15, 4, 14, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        // Set font        
        $this->SetFont('helvetica', 'R', 12);
        $this->MultiCell(100, 10, $this->company, 0, 'L', false, 0, 30, 6, false, 0, false, true, 0, 'T', false);
        //$this->MultiCell(50,10,"Frabelle PNG Ltd.",0,'L',false,0,30,6,false,0,false,true,0,'T',false);

        $this->SetFont('helvetica', 'R', 8);
        $this->MultiCell(50, 10, $this->address, 0, 'L', false, 0, 30, 8, false, 0, false, true, 0, 'T', false);
        //$this->MultiCell(50,10,"Lae City, Papua New Guinea",0,'L',false,0,30,7,false,0,false,true,0,'T',false);

        $this->SetFont('helvetica', 'B', 15);
        $this->Cell(0, 26, $this->page_name, 0, 1, 'R', 0, '', 0, false, 'M', 'B');
        //$this->Cell(0, 26, 'POS - PRODUCT SOLD',0,1,'R', 0, '', 0, false, 'M', 'B');        
        $this->writeHTML("<hr />", true, false, true, false, '');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-35);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $signatory = $_SESSION['signatory'];
        //$this->writeHTML($signatory,true,true);
        $this->writeHTML($this->signatory, true, true);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

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
$pdf->page_name = "POS - INVENTORY";
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
$pdf->AddPage('P', 'A4');


//$pdf->SetFont('helvetica', '', 11);

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