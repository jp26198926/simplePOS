<?php

include('validate.php');
include('config.php');
//$curr_date=date('Y-m-d H:i:s A');
$dt_filename = date('Y-m-d_his');

/* GET ACTIVE BUYER TYPES START */
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
/* GET ACTIVE BUYER TYPES END */

$product = $_GET['product'] ? $_GET['product'] : "All";
$ending_date = $_GET['ending'];
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/library/PHPExcel-1.8/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator($ufullname)
    ->setLastModifiedBy($ufullname)
    ->setTitle($app_name)
    ->setSubject("Inventory Report")
    ->setDescription("Inventory Report")
    ->setKeywords("POS Excel PHP")
    ->setCategory("Download");


// Add some data
$selling_price_column = 'F';
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', $company)
    ->setCellValue('A2', 'Inventory Report')
    ->setCellValue('A3', 'Searched Product')
    ->setCellValue('B3', $product)
    ->setCellValue('A4', 'Date Ending')
    ->setCellValue('B4', $ending_date)

    ->setCellValue('A7', 'CODE')
    ->setCellValue('B7', 'PRODUCT')
    ->setCellValue('C7', 'UOM')
    ->setCellValue('D7', 'CATEGORY')
    ->setCellValue('E7', 'STOCK')
    ->setCellValue('F7', 'SUPPLIER PRICE')
    ->setCellValue('G6', 'SELLING PRICE');
      
foreach ($buyer_list as $buyer){     
    $selling_price_column++;        
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($selling_price_column.'7', $buyer);          
}

$objPHPExcel->getActiveSheet()->mergeCells('G6:' . $selling_price_column . '6');


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A6:E6')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:E6')
    ->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:E6')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


//$objPHPExcel->getActiveSheet()->mergeCells('A4:C4')
//							  ->getStyle('A4:C4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$sql = $_SESSION['inventory_sql'];

if ($sql) {

    include('connect.php');

    $pop = $mysqli->query($sql);
    if ($pop) {
        $count = $pop->num_rows;

        if ($count > 0) {
            $i = 7;
            while ($row = $pop->fetch_object()) {
                $i++;

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

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $code)
                    ->setCellValue('B' . $i, $name)
                    ->setCellValue('C' . $i, $uom)
                    ->setCellValue('D' . $i, $category)
                    ->setCellValue('E' . $i, $current_balance)
                    ->setCellValue('F' . $i, $supplier_price);
                
                
                //get all prices from active buyer type
                $price_sql = "SELECT pp.price as price
                            FROM pos_price pp
                            LEFT JOIN pos_buyer pb ON pb.id = pp.buyer_id AND pb.status_id = 1
                            WHERE pp.product_id={$id} AND pb.status_id=1
                            ORDER BY pb.type;";
                                                            
                $price_pop = $mysqli->query($price_sql);
                
                if ($price_pop){
                    $price_count = $price_pop->num_rows;
                    $selling_price_column = 'G';

                    if ($price_count > 0){
                        while($price_row = $price_pop->fetch_object()){  
                            $price_price = number_format($price_row->price,2,'.',',');
                            
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($selling_price_column . $i, $price_price);
                            $objPHPExcel->getActiveSheet()->getStyle($selling_price_column . $i)->getNumberFormat()->setFormatCode('#,##0.00');
                            $objPHPExcel->getActiveSheet()->getStyle($selling_price_column . $i)->getAlignment()
                                        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            
                            $selling_price_column++;
                        }                            
                    }else{                         
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($selling_price_column . $i, 'No Price Yet');                            
                    }
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($selling_price_column . $i, 'Error');
                }

                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getNumberFormat()->setFormatCode('#,##0.00');


                $objPHPExcel->getActiveSheet()->getStyle('C' . $i . ':C' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':E' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                $objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':E' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

                $objPHPExcel->getActiveSheet()->freezePane('A8');
            }
        } else {
            $objPHPExcel->getActiveSheet()->setCellValue('A8', 'Error: Record to be printed');
            $objPHPExcel->getActiveSheet()->mergeCells('A8:' . $selling_price_column . '8')
                ->getStyle('A7:D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
    } else {
        $objPHPExcel->getActiveSheet()->setCellValue('A8', 'Error: ' . $mysqli->error);
        $objPHPExcel->getActiveSheet()->mergeCells('A8:' . $selling_price_column . '8')
            ->getStyle('A7:D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }
} else {
    $objPHPExcel->getActiveSheet()->setCellValue('A8', 'Error: Critical Error Encountered!');
    $objPHPExcel->getActiveSheet()->mergeCells('A8:' . $selling_price_column . '8')
        ->getStyle('A7:D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}



$mysqli->close();


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Inventory Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="inv_report.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;