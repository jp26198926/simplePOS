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
    ->setTitle("Frabelle POS")
    ->setSubject("Transaction Report")
    ->setDescription("Transaction Report")
    ->setKeywords("POS Excel PHP")
    ->setCategory("Download");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', $company)
    ->setCellValue('A2', 'Transaction Report')
    ->setCellValue('A3', 'Date Exported')
    ->setCellValue('B3', $dt)
    ->setCellValue('A6', 'RECEIPT NO.')
    ->setCellValue('B6', 'DATETIME')

    ->setCellValue('C6', 'PMT TYPE')
    ->setCellValue('D6', 'REFERENCE')
    ->setCellValue('E6', 'AMOUNT DUE')
    ->setCellValue('F6', 'TAX BASE')
    ->setCellValue('G6', 'GST')
    ->setCellValue('H6', 'CASHIER')
    ->setCellValue('I6', 'REMARKS')
    ->setCellValue('J6', 'STATUS');

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


$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:J6')
    ->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:J6')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


//$objPHPExcel->getActiveSheet()->mergeCells('A4:C4')
//							  ->getStyle('A4:C4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$objPHPExcel->getActiveSheet()->getStyle('E6:E6')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$sql = $_SESSION['transaction_sql'];

if ($sql) {

    include('connect.php');

    $pop = $mysqli->query($sql);
    if ($pop) {
        $count = $pop->num_rows;

        if ($count > 0) {
            //$subtotal = 0;
            $i = 6;
            $grand_total = 0;

            $total_due = 0;
            $total_taxbase = 0;
            $total_gst = 0;

            while ($row = $pop->fetch_object()) {
                $i++;

                $id = $row->id;
                //$receipt = str_pad($row->id, 10,"0", STR_PAD_LEFT);
                $receipt = $row->receipt;
                $dt_receipt = $row->dt;
                $subtotal = number_format(floatval($row->subtotal), 2, '.', ',');
                $discount = number_format(floatval($row->discount), 2, '.', ',');
                $discount_type = $row->discount_type;
                $discount_type_word = $row->discount_type_word ? $row->discount_type_word : "No Discount";
                $discount_qty = number_format(floatval($row->discount_qty), 2, '.', ',');
                $amount_due = number_format(floatval($row->amount_due), 2, '.', ',');
                $remarks = $row->remarks;
                $status_id = $row->status_id;
                $cashier = strtoupper($row->cashier);
                $status = $row->status;

                $payment_type = $row->payment_type;
                $reference = $row->reference;

                $total = floatval($row->amount_due);

                // $t_taxbase = $total / 1.1;
                // $t_gst = $t_taxbase * 0.1;
                $t_gst = $total * (floatval($gst_percent) / 100);
                $t_taxbase = $total - $t_gst;

                $total_due += $total;
                $total_taxbase += $t_taxbase;
                $total_gst += $t_gst;

                $taxbase = number_format($t_taxbase, 2, '.', ',');
                $gst = number_format($t_gst, 2, '.', ',');

                $grand_total += $total;

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $receipt)
                    ->setCellValue('B' . $i, $dt_receipt)

                    ->setCellValue('C' . $i, $payment_type)
                    ->setCellValue('D' . $i, $reference)

                    ->setCellValue('E' . $i, $amount_due)
                    ->setCellValue('F' . $i, $taxbase)
                    ->setCellValue('G' . $i, $gst)

                    ->setCellValue('H' . $i, $cashier)
                    ->setCellValue('I' . $i, $remarks)
                    ->setCellValue('J' . $i, $status);

                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getNumberFormat()->setFormatCode('#,##0.00');


                $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':B' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':G' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                //$objPHPExcel->getActiveSheet()->getStyle('D' . $i . ':E' . $i)->getAlignment()
                //            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                //            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //$objPHPExcel->getActiveSheet()->getStyle('F' . $i . ':G' . $i)->getAlignment()
                //            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                //            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $objPHPExcel->getActiveSheet()->getStyle('J' . $i . ':J' . $i)->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':E' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

                $objPHPExcel->getActiveSheet()->freezePane('A7');

                //$objPHPExcel->getActiveSheet()
                //            ->getStyle('E' . $i . ':M' . $i)
                //            ->getNumberFormat()
                //            ->setFormatCode('#,##0.00');

            }
            //display Total
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('D' . ($i + 1), 'GRAND TOTAL')
                ->setCellValue('E' . ($i + 1), $grand_total)
                ->setCellValue('F' . ($i + 1), $total_taxbase)
                ->setCellValue('G' . ($i + 1), $total_gst);

            $objPHPExcel->getActiveSheet()->getStyle('E' . ($i + 1) . ':G' . ($i + 1))->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->getStyle('E' . ($i + 1))->getNumberFormat()->setFormatCode('#,##0.00');
            $objPHPExcel->getActiveSheet()->getStyle('F' . ($i + 1))->getNumberFormat()->setFormatCode('#,##0.00');
            $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 1))->getNumberFormat()->setFormatCode('#,##0.00');

            //$objPHPExcel->getActiveSheet()->getStyle('F' . ($i+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);					
            $objPHPExcel->getActiveSheet()->getStyle('E' . ($i + 1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle('E' . ($i + 1))->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
        } else {
            $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: Record to be printed');
            $objPHPExcel->getActiveSheet()->mergeCells('A7:J7')
                ->getStyle('A7:I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
    } else {
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: ' . $mysqli->error);
        $objPHPExcel->getActiveSheet()->mergeCells('A7:J7')
            ->getStyle('A7:I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }
} else {
    $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Error: Critical Error Encountered!');
    $objPHPExcel->getActiveSheet()->mergeCells('A7:J7')
        ->getStyle('A7:I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}



$mysqli->close();


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Transaction Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="tran_report.xlsx"');
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
