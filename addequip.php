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
                <h3 class="center">ADD EQUIPMENT</h3>
                <form class="form-horizontal" action="addequip-process.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Property ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="propertyid" name="propertyid" placeholder="Enter Property ID" pattern="[0-9]{1,5}" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Enter Item Name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Description:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="itemdesc" name="itemdesc" placeholder="Enter Description" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Date Acquired:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="itemdate" name="itemdate" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Accountable Employee:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="itememploy" name="itememploy" placeholder="Enter Accountable Employee" required="required">
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
         <a href="EquipFormat.xlsx" class="btn btn-default"><span class="glyphicon glyphicon-download"></span> Download Format</a>
         <br><br>
         <input class="form-control" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="file" required="required"/>
            <button type="submit" name="preview" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Preview</button>         
        </form>
               
       <!-- Buat Preview Data -->
      <?php

      $query = mysqli_query($conn, "SELECT * FROM equipment");

      while($row = mysqli_fetch_array($query)) {
         $result_array[] = $row['property_number'];
      }
      // Jika user telah mengklik tombol Preview
      if(isset($_POST['preview'])){

        $nama_file_baru = 'dataequip.xlsx';
        
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
            unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
        
        $tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
        $tmp_file = $_FILES['file']['tmp_name'];
        
        // Cek apakah file yang diupload adalah file Excel(.xlsx)
          move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
          
          // Load librari PHPExcel nya
          require_once 'PHPExcel/PHPExcel.php';
          
          $excelreader = new PHPExcel_Reader_Excel2007();
          $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
          $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
          
          // Buat sebuah tag form untuk proses import data ke database
          echo "<form method='post' action='import-equip.php' style='padding-top: 20px'>";
          
          // Buat sebuah div untuk alert validasi kosong
          echo "<div class='alert alert-danger' id='kosong'>
          Error! check the red one.
          </div>";
          
          echo "<table class='table table-striped table-bordered'>
          <tr>
            <th colspan='5' class='text-center'>Preview Data</th>
          </tr>
          <tr>
            <th>Property ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Date Acquired</th>
            <th>Accountable Employee</th>
          </tr>";

          $numrow = 1;
          $kosong = 0;
          foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
            // Ambil data pada excel sesuai Kolom
            $property_id = $row['A'];
            $item_name = $row['B']; // Ambil data nama
            $description = $row['C']; // Ambil data jenis kelamin
            $date_acquired = $row['D']; // Ambil data telepon
            $accountable_employee = $row['E']; // Ambil data alamat


            $checker = 0;

            for ($k=0; $k < count($result_array); $k++) { 
              if ($property_id == $result_array[$k]) {
                $checker++;
              }
            }
            
            // Cek jika semua data tidak diisi
            if(empty($property_id) && empty($item_name) && empty($description) && empty($date_acquired) && empty($accountable_employee))
              continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
            
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport

            if($numrow > 1){

              // Validasi apakah semua data telah diisi
              $property_id_td = ( !empty($property_id) and $checker == 0 )? "" : " style='background: #E07171;'";
              $item_name_td = ( !empty($item_name))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
              $description_td = ( !empty($description))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
              $date_acquired_td = ( !empty($date_acquired))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
              $accountable_employee_td = ( !empty($accountable_employee))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

              // Jika salah satu data ada yang kosong
              if (empty($property_id) or empty($item_name) or empty($description) or empty($date_acquired) or empty($accountable_employee) or $checker == 1){
                $kosong++; // Tambah 1 variabel $kosong
              }
              
              echo "<tr>";
              echo "<td".$property_id_td.">".$property_id."</td>";
              echo "<td".$item_name_td.">".$item_name."</td>";
              echo "<td".$description_td.">".$description."</td>";
              echo "<td".$date_acquired_td.">".$date_acquired."</td>";
              echo "<td".$accountable_employee_td.">".$accountable_employee."</td>";
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
      ?>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

<?php
include 'footer.php';
?>
</html>