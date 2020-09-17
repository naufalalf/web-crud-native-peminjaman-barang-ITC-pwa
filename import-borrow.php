<?php

include "db.php";

if(isset($_POST['import'])){ 
  $nama_file_baru = 'databorrow.xlsx';
 
  require_once 'PHPExcel/PHPExcel.php';

  $excelreader = new PHPExcel_Reader_Excel2007();
  $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); 
  $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

  $numrow = 1;
  foreach($sheet as $row){

    $employee_id = $row['A'];
    $employee_first_name = $row['B']; 
    $employee_last_name = $row['C']; 
    $employee_middle_name = $row['D'];
    $status = $row['E']; 

    if(empty($employee_id) && empty($employee_first_name) && empty($employee_last_name) && empty($employee_middle_name) && empty($status))
      continue; 

    if($numrow > 1){
    
      $query = "INSERT INTO borrowers VALUES('".$employee_id."','".$employee_first_name."','".$employee_last_name."','".$employee_middle_name."','".$status."')";

      mysqli_query($conn, $query);
    }
    $numrow++; 
  }
}
header('location: viewborrow.php'); 
?>