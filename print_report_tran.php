<?php
    
// Include the main    
    include("validate.php");
    
    if (!empty($_SESSION['transaction_sql']) || $_SESSION['transaction_sql']!=''){
        $sql = $_SESSION['transaction_sql'];
        
        $output='';
        $items='';
        
        /*
        $search_emp='';
        $search_covered='';        
        $search_dept='';
        $search_cc='';
        
        if (!empty($_SESSION['search_emp'])){
            $search_emp = $_SESSION['search_emp'];
        }
        if (!empty($_SESSION['search_covered'])){
            $search_covered = $_SESSION['search_covered'];
        }
        if (!empty($_SESSION['search_dept'])){
            $search_dept=$_SESSION['search_dept'];
        }
        if (!empty($_SESSION['search_cc'])){
            $search_cc=$_SESSION['search_cc'];
        }
        
        
        $details = " <table>
                        <tr>
                            <td align=\"right\" width=\"10%\">Employee </td>
                            <td align=\"left\" width=\"40%\"> : {$search_emp}</td>                                
                                
                            <td align=\"right\">Date Covered</td>
                            <td align=\"left\"> : <b>{$search_covered}</b> </td>        
                        </tr>
                        <tr>        
                            <td align=\"right\" width=\"10%\">CC / Dept</td>
                            <td align=\"left\" width=\"40%\"> : {$search_cc} / {$search_dept}</td>
                                
                            <td align=\"right\">Date Printed</td>
                            <td align=\"left\"> : {$dt} </td>       
                        </tr>
                            
                    </table>";
        */
        
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
                                <th  rowspan=\"1\" width=\"10%\" ><b>RECEIPT</b></th>
                                <th  rowspan=\"1\" width=\"10%\" ><b>DATETIME</b></th>
                                
                                <!--
                                <th  rowspan=\"2\" width=\"10%\" ><b>SUBTOTAL</b></th>                              
                                <th  colspan=\"3\" width=\"30%\" ><b>DISCOUNT</b></th>
                                -->
                                
                                <th  rowspan=\"1\" width=\"10%\" ><b>AMOUNT DUE</b></th>
                                <th  rowspan=\"1\" width=\"10%\" ><b>TAX BASE</b></th>
                                <th  rowspan=\"1\" width=\"10%\" ><b>GST</b></th>
                                
                                <th  rowspan=\"1\" width=\"18%\" ><b>CASHIER</b></th>
                                
                                <th  rowspan=\"1\" width=\"20%\" ><b>REMARKS</b></th>
                                
                                <th  rowspan=\"1\" width=\"12%\" ><b>STATUS</b></th>                                    
                            </tr>
                            <!--
                            <tr align=\"center\" >
                                <th width=\"14%\" >TYPE</th>
                                <th width=\"8%\" >VALUE</th>
                                <th width=\"8%\" >TOTAL</th>                                
                            </tr>
                            -->";
                            
            include ('connect.php');
            
            $pop = $mysqli->query($sql);
            if ($pop){
                $count = $pop->num_rows;
                if ($count > 0){
                    $grand_total = 0;
                    
                    $total_due = 0;
                    $total_taxbase = 0;
                    $total_gst = 0;
                    
                    while($row=$pop->fetch_object()){
                        $id = $row->id;
                        //$receipt = str_pad($row->id, 10,"0", STR_PAD_LEFT);
                        $receipt = $row->receipt;
                        $dt_receipt = $row->dt;
                        $subtotal = number_format(floatval($row->subtotal) ,2 ,'.' ,',');
                        $discount = number_format(floatval($row->discount) ,2 ,'.' ,',');
                        $discount_type = $row->discount_type;
                        $discount_type_word = $row->discount_type_word ? $row->discount_type_word : "No Discount";
                        $discount_qty = number_format(floatval($row->discount_qty) ,2 ,'.' ,',');           
                        $amount_due = number_format(floatval($row->amount_due) ,2 ,'.' ,',');
                        $remarks = $row->remarks;
                        $status_id = $row->status_id;
                        $cashier = strtoupper($row->cashier);
                        $status = $row->status;
                        
                        $total = floatval($row->amount_due);
                        
                        $t_taxbase = $total / 1.1;
                        $t_gst = $t_taxbase * 0.1;
                        
                        $total_due += $total;
                        $total_taxbase += $t_taxbase;
                        $total_gst += $t_gst;
                        
                        $taxbase = number_format($t_taxbase,2,'.',',');
                        $gst = number_format($t_gst,2,'.',',');
                        
                        $grand_total += $total;
                        
                        $tbl_list .=  "<tr align=\"center\" >";                              
                        $tbl_list .=  "  <th>" . $receipt . "</th>";
                        $tbl_list .=  "  <th>" . $dt_receipt . "</th>";
                        
                        /*
                        $tbl_list .=  "  <th align=\"right\" >" . $subtotal . "</th>";                            
                        $tbl_list .=  "  <th>" . $discount_type_word . "</th>";
                        $tbl_list .=  "  <th align=\"right\" >" . $discount_qty . "</th>";
                        $tbl_list .=  "  <th align=\"right\" >" . $discount . "</th>";
                        */
                        
                        $tbl_list .=  "  <th align=\"right\" >" . $amount_due . "</th>";
                        $tbl_list .=  "  <th align=\"right\" >" . $taxbase . "</th>";
                        $tbl_list .=  "  <th align=\"right\" >" . $gst . "</th>";
                        $tbl_list .=  "  <th>" . $cashier . "</th>";
                        $tbl_list .=  "  <th>" . $remarks . "</th>";
                        $tbl_list .=  "  <th>" . $status . "</th>";                                   
                        $tbl_list .=  "</tr>";
                    }
                    
                    $tbl_list .=  "<tr>
                                        <td colspan=\"2\"><b>GRAND TOTAL</b></td>
                                        <td align=\"right\"><b>" . number_format($grand_total,2,'.',',') . "</b></td>
                                        <td align=\"right\"><b>" . number_format($total_taxbase,2,'.',',') . "</b></td>
                                        <td align=\"right\"><b>" . number_format($total_gst,2,'.',',') . "</b></td>
                                  </tr>";
                }else{
                    $tbl_list .= "<tr><td colspan=\"8\">No Record</td></tr>";
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

    //Page header
    public function Header() {
        // Logo
        $image_file = 'images/png80.png';
        $this->Image($image_file, 15,4, 14,'', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font        
        $this->SetFont('helvetica', 'R', 12);       
        $this->MultiCell(50,10,"Frabelle PNG Ltd.",0,'L',false,0,30,6,false,0,false,true,0,'T',false);
        
        $this->SetFont('helvetica', 'R', 8);       
        $this->MultiCell(50,10,"Lae City, Papua New Guinea",0,'L',false,0,30,7,false,0,false,true,0,'T',false);
        
        $this->SetFont('helvetica', 'B', 15);        
        $this->Cell(0, 26, 'POS - TRANSACTION',0,1,'R', 0, '', 0, false, 'M', 'B');        
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
        $this->writeHTML($signatory,true,true);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages() , 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        $preparedby = $_SESSION['ufullname'];
        //$rep = $_SESSION['rep'];
        
        
    }
    
    
}

// create new PDF document
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

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


//$pdf->writeHTML($details,true,false,false,false,'');

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