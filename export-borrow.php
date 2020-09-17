<?php

session_start();

$coba = $_SESSION['coba'];
$search = $_SESSION['search'];
  
  // Load file koneksi.php
include "db.php";

//while($data = mysqli_fetch_array($sql)){// Ambil semua data dari hasil eksekusi $sql
//echo "<tr>";
  //echo "<td>".$data['item_name']."</td>";
  //echo "<td>".$data['employee_first_name']."</td>";
  //echo "<td>".$data['date_borrowed']."</td>";
  //echo "<td>".$data['date_returned']."</td>";
  //echo "<td>".$data['status']."</td>";
//echo "</tr>";
//}

require_once 'PHPExcel/PHPExcel.php';
  // Panggil class PHPExcel nya
$excel = new PHPExcel();
// Settingan awal file excel
$excel->getProperties()->setCreator('naufal')
           ->setLastModifiedBy('')
           ->setTitle("")
           ->setSubject("")
           ->setDescription("")
           ->setKeywords("");
  //Style kolom
  $style_col = array(
  'font' => array('bold' => true), // Set font nya jadi bold
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);
//Style row
$style_row = array(
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);
//Set header
$excel->setActiveSheetIndex(0)->setCellValue('A1', "VIEW BORROWERS REPORT");
$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "EMPLOYEE ID");
$excel->setActiveSheetIndex(0)->setCellValue('B3', "EMPLOYEE FIRST NAME");
$excel->setActiveSheetIndex(0)->setCellValue('C3', "EMPLOYEE LAST NAME");
$excel->setActiveSheetIndex(0)->setCellValue('D3', "EMPLOYEE MIDDLE NAME");
$excel->setActiveSheetIndex(0)->setCellValue('E3', "STATUS");
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);

if ($coba == 1 and !empty($search)) {
  $sql = mysqli_query($conn, "SELECT * FROM borrowers WHERE employee_id = '$search'");
}
else if ($coba == 2 and !empty($search)) {
  $sql = mysqli_query($conn, "SELECT * FROM borrowers WHERE employee_first_name LIKE '$search%'");
}
else if ($coba == 3 and !empty($search)) {
  $sql = mysqli_query($conn, "SELECT * FROM borrowers WHERE employee_last_name LIKE '$search%'");
}
else if ($coba == 4 and !empty($search)) {
  $sql = mysqli_query($conn, "SELECT * FROM borrowers WHERE employee_middle_name LIKE '$search%'");
}
else if ($coba == 5 and !empty($search)) {
  $sql = mysqli_query($conn, "SELECT * FROM borrowers WHERE employee_status LIKE '$search%'");
}
else {
  $sql = mysqli_query($conn, "SELECT * FROM borrowers");
}

$numrow = 3;
while ($row = mysqli_fetch_array($sql)) {
  $numrow++;
  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $row['employee_id'], PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row['employee_first_name'], PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row['employee_last_name'], PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValueExplicit('D'.$numrow, $row['employee_middle_name'], PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $row['employee_status'], PHPExcel_Cell_DataType::TYPE_STRING);

  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
  
}
// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Report");
$excel->setActiveSheetIndex(0);
// Proses file excel
// $objWriter = new PHPExcel_Writer_Excel2007($excel); 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="View Borrowers Report.xls"'); // Set nama file excel nya
header('Cache-Control: max-age=0');
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
// $write = PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
$write->save('php://output');
exit;

?>