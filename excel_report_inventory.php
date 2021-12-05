<?php
    
    include('validate.php');
	//$curr_date=date('Y-m-d H:i:s A');
	$dt_filename=date('Y-m-d_his');

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
							 ->setTitle("Frabelle POS")
							 ->setSubject("Inventory Report")
							 ->setDescription("Inventory Report")
							 ->setKeywords("POS Excel PHP")
							 ->setCategory("Download");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Frabelle (PNG) Limited')
            ->setCellValue('A2', 'Inventory Report')
            ->setCellValue('A3', 'Searched Product')
			->setCellValue('B3', $product)
			->setCellValue('A4', 'Date Ending')
			->setCellValue('B4', $ending_date)

            ->setCellValue('A6', 'PRODUCT CODE')
            ->setCellValue('B6', 'PRODUCT NAME')
			->setCellValue('C6', 'UOM')
			->setCellValue('D6', 'STOCK')			
            ;

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);			
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:D6')
            ->getAlignment()->setWrapText(true); 
            
$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	

//$objPHPExcel->getActiveSheet()->mergeCells('A4:C4')
//							  ->getStyle('A4:C4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$objPHPExcel->getActiveSheet()->getStyle('D6:D6')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

    $sql = $_SESSION['inventory_sql'];
      
    if ($sql){
         
        include('connect.php');  
        
        $pop = $mysqli->query($sql);
        if ($pop){
            $count=$pop->num_rows;
			
			if ($count > 0){
				$i = 6;
                while($row=$pop->fetch_object()){
					$i++;
					
					$id = $row->id;
                    $code = $row->product_code;
                    $name = $row->product_name;
                       
                    $stock = floatval($row->stock);
                    $sale = floatval($row->sale);

                    $uom = $row->product_uom;               
                    $status_id = $row->status_id;
                    $status = $row->status;
                        
                    $current_balance = $stock - $sale;
					
					$objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$i, $code)
                                    ->setCellValue('B'.$i, $name)
									->setCellValue('C'.$i, $uom)
									->setCellValue('D'.$i, $current_balance)									
									;                                    
                        
						$objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
                        
                        
                        $objPHPExcel->getActiveSheet()->getStyle('C' . $i . ':C' . $i)->getAlignment()
                                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                        $objPHPExcel->getActiveSheet()->getStyle('D' . $i . ':D' . $i)->getAlignment()
                                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);						
							
    
                        $objPHPExcel->getActiveSheet()->getStyle('D' . $i . ':D' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                        
                        $objPHPExcel->getActiveSheet()->freezePane('A7');
				}	
						
				 
			}else{
				$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: Record to be printed');
				$objPHPExcel->getActiveSheet()->mergeCells('A7:D7')
                                          ->getStyle('A7:D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}                   
            
        }else{
            $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: ' . $mysqli->error);
            $objPHPExcel->getActiveSheet()->mergeCells('A7:D7')
                                          ->getStyle('A7:D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
    }else{
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: Critical Error Encountered!');
        $objPHPExcel->getActiveSheet()->mergeCells('A7:D7')
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
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
