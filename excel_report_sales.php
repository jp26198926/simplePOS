<?php

include('validate.php');
include('config.php');
//$curr_date=date('Y-m-d H:i:s A');
$dt_filename = date('Y-m-d_his');
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
    ->setSubject("Sales Report")
    ->setDescription("Sales Report")
    ->setKeywords("POS Excel PHP")
    ->setCategory("Download");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', $company)
    ->setCellValue('A2', 'Item Sold Report')
    ->setCellValue('A3', 'Date Exported')
    ->setCellValue('B3', $dt)
    ->setCellValue('A6', 'DATE')
    ->setCellValue('B6', 'RECEIPT')
    ->setCellValue('C6', 'PRODUCT CODE')
    ->setCellValue('D6', 'PRODUCT NAME')
    ->setCellValue('E6', 'QTY')
    ->setCellValue('F6', 'UOM')
    ->setCellValue('G6', 'CATEGORY')
    ->setCellValue('H6', 'BUYER TYPE')
    ->setCellValue('I6', 'PAYMENT')
    ->setCellValue('J6', 'PRICE')
    ->setCellValue('K6', 'TOTAL')
    ->setCellValue('L6', 'TAXBASE')
    ->setCellValue('M6', 'GST')
    ->setCellValue('N6', 'STATUS');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);


$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A6:N6')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:N6')
    ->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:N6')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


//$objPHPExcel->getActiveSheet()->mergeCells('A4:C4')
//							  ->getStyle('A4:C4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$objPHPExcel->getActiveSheet()->getStyle('K6:K6')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$sql = $_SESSION['sales_sql'];

if ($sql) {

    include('connect.php');

    $pop = $mysqli->query($sql);
    if ($pop) {
        $count = $pop->num_rows;

        if ($count > 0) {
            //$subtotal = 0;
            $i = 6;
            //$grand_total = 0;

            $total_qty = 0;
            $total_total = 0;
            $total_taxbase = 0;
            $total_gst = 0;

            while ($row = $pop->fetch_object()) {
                $i++;

                $id = $row->id;
                $tran_id = $row->tran_id;
                //$receipt = str_pad($row->tran_id, 10,"0", STR_PAD_LEFT);
                $receipt = $row->receipt;
                $dt_sale = $row->dt;
                $product_code = $row->product_code;
                $product_name = $row->product_name;
                $uom = $row->uom;
                $qty = $row->qty;
                $category = $row->category;
                $buyer_type = strtoupper($row->buyer_type);
                $payment_type = $row->payment_type;

                $price = number_format(floatval($row->price), 2, '.', ',');

                $discount_type = $row->discount_type;
                $discount_type_word = $row->discount_type_word ? $row->discount_type_word : "No Discount";
                $discount_qty = number_format(floatval($row->discount_qty), 2, '.', ',');
                $discount_total = number_format(floatval($row->discount_total), 2, '.', ',');

                $total = number_format(floatval($row->total), 2, '.', ',');

                $t_total = floatval($row->total);
                $t_taxbase = $t_total / 1.1;
                $t_gst = $t_taxbase * 0.1;

                $total_qty += floatval($qty);
                $total_total += $t_total;
                $total_taxbase += $t_taxbase;
                $total_gst += $t_gst;

                $taxbase = number_format(($t_taxbase), 2, '.', ',');
                $gst = number_format(($t_gst), 2, '.', ',');

                $status_id = $row->status_id;
                $status = $row->status;


                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $dt_sale)
                    ->setCellValue('B' . $i, $receipt)
                    ->setCellValue('C' . $i, $product_code)
                    ->setCellValue('D' . $i, $product_name)
                    ->setCellValue('E' . $i, $qty)
                    ->setCellValue('F' . $i, $uom)
                    ->setCellValue('G' . $i, $category)
                    ->setCellValue('H' . $i, $buyer_type)
                    ->setCellValue('I' . $i, $payment_type)
                    ->setCellValue('J' . $i, $price)
                    ->setCellValue('K' . $i, $total)
                    ->setCellValue('L' . $i, $taxbase)
                    ->setCellValue('M' . $i, $gst)
                    ->setCellValue('N' . $i, $status);

                $objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('M' . $i)->getNumberFormat()->setFormatCode('#,##0.00');


                $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':B' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->getStyle('C' . $i . ':D' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                $objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':G' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->getStyle('J' . $i . ':N' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $objPHPExcel->getActiveSheet()->getStyle('J' . $i . ':J' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                /*									
						$objPHPExcel->getActiveSheet()->getStyle('J' . $i . ':L' . $i)->getAlignment()
                                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
									
						$objPHPExcel->getActiveSheet()->getStyle('M' . $i . ':M' . $i)->getAlignment()
                                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
						*/

                $objPHPExcel->getActiveSheet()->getStyle('M' . $i . ':M' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

                $objPHPExcel->getActiveSheet()->freezePane('A7');

                //$objPHPExcel->getActiveSheet()
                //            ->getStyle('E' . $i . ':M' . $i)
                //            ->getNumberFormat()
                //            ->setFormatCode('#,##0.00');

            }
            //display Total
            $i++;

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, "GRAND TOTAL")
                ->setCellValue('E' . $i, $total_qty)
                ->setCellValue('K' . $i, $total_total)
                ->setCellValue('L' . $i, $total_taxbase)
                ->setCellValue('M' . $i, $total_gst);

            $objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
            $objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
            $objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
            $objPHPExcel->getActiveSheet()->getStyle('M' . $i)->getNumberFormat()->setFormatCode('#,##0.00');


            $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':B' . $i)->getAlignment()
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle('C' . $i . ':D' . $i)->getAlignment()
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            $objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':G' . $i)->getAlignment()
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle('J' . $i . ':M' . $i)->getAlignment()
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            // $objPHPExcel->getActiveSheet()->getStyle('I' . $i . ':I' . $i)->getAlignment()
            //     ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
            //     ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle('M' . $i . ':M' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
        } else {
            $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: Record to be printed');
            $objPHPExcel->getActiveSheet()->mergeCells('A7:N7')
                ->getStyle('A7:M7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
    } else {
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: ' . $mysqli->error);
        $objPHPExcel->getActiveSheet()->mergeCells('A7:N7')
            ->getStyle('A7:M7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }
} else {
    $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: Critical Error Encountered!');
    $objPHPExcel->getActiveSheet()->mergeCells('A7:N7')
        ->getStyle('A7:N7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}



$mysqli->close();


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Sales Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="sales_report.xlsx"');
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