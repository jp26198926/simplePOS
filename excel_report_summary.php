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
	->setSubject("Sales Summary Report")
	->setDescription("Sales Summary Report")
	->setKeywords("POS Excel PHP")
	->setCategory("Download");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', $company)
	->setCellValue('A2', 'Sales Summary Report')

	->setCellValue('A3', 'Date Exported')
	->setCellValue('B3', $dt)

	->setCellValue('A4', 'Search Product')
	->setCellValue('B4', $_SESSION['sales_product_summary'])

	->setCellValue('A5', 'From Date')
	->setCellValue('B5', $_SESSION['sales_dtfrom_summary'])

	->setCellValue('A6', 'To Date')
	->setCellValue('B6', $_SESSION['sales_dtto_summary'])

	->setCellValue('A8', 'PRODUCT CODE')
	->setCellValue('B8', 'PRODUCT NAME')
	->setCellValue('C8', 'UOM')
	->setCellValue('D8', 'CATEGORY')
	->setCellValue('E8', 'INSIDER') //
	->setCellValue('G8', 'OUTSIDER')
	->setCellValue('I8', 'KITCHEN')
	->setCellValue('K8', 'SALE')
	->setCellValue('M8', 'OVERALL TOTAL')

	->setCellValue('E9', 'QTY')
	->setCellValue('F9', 'TOTAL')

	->setCellValue('G9', 'QTY')
	->setCellValue('H9', 'TOTAL')

	->setCellValue('I9', 'QTY')
	->setCellValue('J9', 'TOTAL')

	->setCellValue('K9', 'QTY')
	->setCellValue('L9', 'TOTAL')

	->setCellValue('M9', 'QTY')
	->setCellValue('N9', 'TOTAL');

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

$objPHPExcel->getActiveSheet()->mergeCells('A8:A9');
$objPHPExcel->getActiveSheet()->mergeCells('B8:B9');
$objPHPExcel->getActiveSheet()->mergeCells('C8:C9');
$objPHPExcel->getActiveSheet()->mergeCells('D8:D9');
$objPHPExcel->getActiveSheet()->mergeCells('E8:F8');
$objPHPExcel->getActiveSheet()->mergeCells('G8:H8');
$objPHPExcel->getActiveSheet()->mergeCells('I8:J8');
$objPHPExcel->getActiveSheet()->mergeCells('K8:L8');
$objPHPExcel->getActiveSheet()->mergeCells('M8:N8');

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('L8:N9')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A8:N9')
	->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle('A8:N9')->getAlignment()
	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->getStyle('E6:N7')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

$sql = $_SESSION['sales_sql_summary'];

if ($sql) {

	include('connect.php');

	$pop = $mysqli->query($sql);
	if ($pop) {
		$count = $pop->num_rows;

		if ($count > 0) {

			$i = 9;

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
				$i++;

				$product_code = $row->product_code;
				$product_name = $row->product_name;
				$uom = $row->uom;
				$category = $row->category;

				$qty = floatval($row->qty) > 0.01 ? number_format(floatval($row->qty), 2, '.', ',') : "";
				$qty_insider = floatval($row->qty_insider) > 0.01 ? number_format(floatval($row->qty_insider), 2, '.', ',') : "";
				$qty_outsider = floatval($row->qty_outsider) > 0.01 ? number_format(floatval($row->qty_outsider), 2, '.', ',') : "";
				$qty_kitchen = floatval($row->qty_kitchen) > 0.01 ? number_format(floatval($row->qty_kitchen), 2, '.', ',') : "";
				$qty_sale = floatval($row->qty_sale) > 0.01 ? number_format(floatval($row->qty_sale), 2, '.', ',') : "";
				/*
					$discount_qty = number_format(floatval($row->discount_qty) ,2 ,'.' ,',');           
					*/

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

				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A' . $i, $product_code)
					->setCellValue('B' . $i, $product_name)
					->setCellValue('C' . $i, $uom)
					->setCellValue('D' . $i, $category)
					->setCellValue('E' . $i, $qty_insider)
					->setCellValue('F' . $i, $total_insider)
					->setCellValue('G' . $i, $qty_outsider)
					->setCellValue('H' . $i, $total_outsider)
					->setCellValue('I' . $i, $qty_kitchen)
					->setCellValue('J' . $i, $total_kitchen)
					->setCellValue('K' . $i, $qty_sale)
					->setCellValue('L' . $i, $total_sale)
					->setCellValue('M' . $i, $qty)
					->setCellValue('N' . $i, $total);

				$objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('I' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('M' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
				$objPHPExcel->getActiveSheet()->getStyle('N' . $i)->getNumberFormat()->setFormatCode('#,##0.00');

				$objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':C' . $i)->getAlignment()
					->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
					->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':N' . $i)->getAlignment()
					->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
					->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


				$objPHPExcel->getActiveSheet()->getStyle('M' . $i . ':N' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

				$objPHPExcel->getActiveSheet()->freezePane('A10');
			}
			//display Total
			$i++;

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A' . $i, "GRAND TOTAL")
				->setCellValue('E' . $i, $total_qty_i)
				->setCellValue('F' . $i, $total_total_i)
				->setCellValue('G' . $i, $total_qty_o)
				->setCellValue('H' . $i, $total_total_o)
				->setCellValue('I' . $i, $total_qty_k)
				->setCellValue('J' . $i, $total_total_k)
				->setCellValue('K' . $i, $total_qty_s)
				->setCellValue('L' . $i, $total_total_s)
				->setCellValue('M' . $i, $total_qty)
				->setCellValue('N' . $i, $total_total);

			$objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('I' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('M' . $i)->getNumberFormat()->setFormatCode('#,##0.00');
			$objPHPExcel->getActiveSheet()->getStyle('N' . $i)->getNumberFormat()->setFormatCode('#,##0.00');

			$objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':C' . $i)->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':N' . $i)->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


			$objPHPExcel->getActiveSheet()->getStyle('E' . $i . ':N' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

			$objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':N' . $i)->getFont()->setBold(true);

			$objPHPExcel->getActiveSheet()->mergeCells('A' . $i . ':C' . $i);

			$objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':A' . $i)->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		} else {
			$objPHPExcel->getActiveSheet()->setCellValue('A10', 'Error: No Record to be printed');
			$objPHPExcel->getActiveSheet()->mergeCells('A10:N10')
				->getStyle('A10:K10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
	} else {
		$objPHPExcel->getActiveSheet()->setCellValue('A10', 'Error: ' . $mysqli->error);
		$objPHPExcel->getActiveSheet()->mergeCells('A10:N10')
			->getStyle('A10:K10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	}
} else {
	$objPHPExcel->getActiveSheet()->setCellValue('A10', 'Error: Critical Error Encountered!');
	$objPHPExcel->getActiveSheet()->mergeCells('A10:N10')
		->getStyle('A10:K10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

$mysqli->close();






// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Sales Summary Report');


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
