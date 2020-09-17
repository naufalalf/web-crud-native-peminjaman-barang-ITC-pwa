<?php
include 'header.php';
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        #loading{
      background: whitesmoke;
      position: absolute;
      top: 140px;
      left: 82px;
      padding: 5px 10px;
      border: 1px solid #ccc;
    }
    </style>

        <script src="js/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
            // Sembunyikan alert validasi kosong
            $("#kosong").hide();
        });
        </script>
</head>
    <body>
        <!-- Subtitle -->
        <div class="col-12">
            <div class="col-3">&nbsp;</div>
            <div class="col-6" style="padding-bottom: 40px">
                <h3 class="center">ADD BORROWER</h3>
                <form class="form-horizontal" action="addborrow-process.php" method="post">
                  <div class="form-group">
                        <label class="control-label col-sm-2">Employee ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employeeid" name="employeeid" placeholder="Enter Employee ID" pattern="[0-9]{1,5}" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">First Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_first" name="employeefirst" placeholder="Enter First Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Last Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_last" name="employeelast" placeholder="Enter Last Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Middle Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_middle" name="employeemiddle" placeholder="Enter Middle Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Status Employee:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_status" name="employeestatus" placeholder="Enter Status" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>

    <!-- <add data excel to database> -->
    <div style="padding: 0 15px;">
    
      <h4 align="center"><b><hr>OR</hr></b></h4>
      <p align="center">You can Import your data from excel files</p>
      <hr>
      
      <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
        <form method="post" class="form-inline" action="" enctype="multipart/form-data">
         <a href="EmployFormat.xlsx" class="btn btn-default"><span class="glyphicon glyphicon-download"></span> Download Format</a>
         <br><br>
         <input class="form-control" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="file"/>
            <button type="submit" name="preview" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Preview</button>         
        </form>
               
       <!-- Buat Preview Data -->
      <?php
      
      $query = mysqli_query($conn, "SELECT * FROM borrowers");

      while($row = mysqli_fetch_array($query)) {
         $result_array[] = $row['employee_id'];
      }
      // Jika user telah mengklik tombol Preview
      if(isset($_POST['preview'])){
        $nama_file_baru = 'databorrow.xlsx';
        
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
            unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
        
        $tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
        $tmp_file = $_FILES['file']['tmp_name'];
        
        // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
        //if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
          // Upload file yang dipilih ke folder tmp
          move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
          
          // Load librari PHPExcel nya
          require_once 'PHPExcel/PHPExcel.php';
          
          $excelreader = new PHPExcel_Reader_Excel2007();
          $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
          $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
          
          // Buat sebuah tag form untuk proses import data ke database
          echo "<form method='post' action='import-borrow.php' style='padding-top: 20px'>";
          
          // Buat sebuah div untuk alert validasi kosong
          echo "<div class='alert alert-danger' id='kosong'>
          Error! check the red one.
          </div>";
          
          echo "<table class='table table-bordered table-striped'>
          <tr>
            <th colspan='5' class='text-center'>Preview Data</th>
          </tr>
          <tr>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Status Employee</th>
          </tr>";
          
          $numrow = 1;
          $kosong = 0;
          foreach($sheet as $row){ 

            $employee_id = $row['A'];
            $employee_first_name = $row['B'];
            $employee_last_name = $row['C']; 
            $employee_middle_name = $row['D'];
            $status = $row['E'];

            $checker = 0;

            for ($k=0; $k < count($result_array); $k++) { 
              if ($employee_id == $result_array[$k]) {
                $checker++;
              }
            }
            
            // Cek jika semua data tidak diisi
            if(empty($employee_id) && empty($employee_first_name) && empty($employee_last_name) && empty($employee_middle_name) && empty($status))
              continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
            
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 1){
              // Validasi apakah semua data telah diisi
              $employee_id_td = ( !empty($employee_id) and $checker == 0)? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
              $employee_first_name_td = ( !empty($employee_first_name))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
              $employee_last_name_td = ( !empty($employee_last_name))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
              $employee_middle_name_td = ( !empty($employee_middle_name))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
              $status_td = ( ! empty($status))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
              
              // Jika salah satu data ada yang kosong
              if(empty($employee_id) or empty($employee_first_name) or empty($employee_last_name) or empty($employee_middle_name) or empty($status) or $checker == 1){
                $kosong++; // Tambah 1 variabel $kosong
              }
              
              echo "<tr>";
              echo "<td".$employee_id_td.">".$employee_id."</td>";
              echo "<td".$employee_first_name_td.">".$employee_first_name."</td>";
              echo "<td".$employee_last_name_td.">".$employee_last_name."</td>";
              echo "<td".$employee_middle_name_td.">".$employee_middle_name."</td>";
              echo "<td".$status_td.">".$status."</td>";
              echo "</tr>";
            }
            
            $numrow++; // Tambah 1 setiap kali looping
          }
          
          echo "</table>";
          
          // Cek apakah variabel kosong lebih dari 0
          // Jika lebih dari 0, berarti ada data yang masih kosong
          if($kosong > 0){
          ?>  
            <script>
            $(document).ready(function(){
              // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
              $("#jumlah_kosong").html('<?php echo $kosong; ?>');
              
              $("#kosong").show(); // Munculkan alert validasi kosong
            });
            </script>
          <?php
          }else{ // Jika semua data sudah diisi
            echo "<hr>";
            
            // Buat sebuah tombol untuk mengimport data ke database
            echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
          }
          
          echo "</form>";
        }
        //else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
          // Munculkan pesan validasi
          //echo "<div class='alert alert-danger'>
          //Hanya File Excel 2007 (.xlsx) yang diperbolehkan
          //</div>";
        //}
      ?>
            </div>
            </div>
        </div>
     

</body>
<?php
include 'footer.php';
?>
</html>