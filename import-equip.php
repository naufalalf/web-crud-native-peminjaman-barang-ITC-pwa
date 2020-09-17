<?php

include "db.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
  $nama_file_baru = 'dataequip.xlsx';
  // Load librari PHPExcel nya
  require_once 'PHPExcel/PHPExcel.php';

  $excelreader = new PHPExcel_Reader_Excel2007();
  $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
  $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

  $numrow = 1;
  foreach($sheet as $row){
    // Ambil data pada excel sesuai Kolom
    $property_id = $row['A'];
    $item_name = $row['B']; // Ambil data nama
    $description = $row['C']; // Ambil data jenis kelamin
    $date_acquired = $row['D']; // Ambil data telepon
    $accountable_employee = $row['E']; // Ambil data alamat
    // Cek jika semua data tidak diisi
    if(empty($property_id) && empty($item_name) && empty($description) && empty($date_acquired) && empty($accountable_employee))
      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport
    if($numrow > 1){
      // Buat query Insert
      $query = "INSERT INTO equipment (property_number, item_name, description, date_acquired, accountable_employee) VALUES ('$property_id' ,'$item_name','$description','$date_acquired','$accountable_employee')";

      // Eksekusi $query
      mysqli_query($conn, $query);
    }
    $numrow++; // Tambah 1 setiap kali looping
  }
}
header('location: viewequip.php'); // Redirect ke halaman awal

?>