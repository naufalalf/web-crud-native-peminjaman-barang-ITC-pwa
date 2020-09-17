<?php
include 'header.php';
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <body>
    <h3 align="center" style="padding-bottom: 20px">VIEW BORROWERS</h3>
    <div class="col-12">
      <div class="col-1">&nbsp;</div>
      <div class="col-10">
        <form class="col-5" method="post" style="padding-bottom: 10px">
          <select class="col-3 form-control" name="coba" required="">
            <option value="" disabled="" selected="">Field..</option>
            <option value="1">Employee ID</option>
            <option value="2">First Name</option>
            <option value="3">Last Name</option>
            <option value="4">Middle Name</option>
            <option value="5">Status</option>
          </select>
          <input type="text" class="form-control col-8" placeholder="Search.." name="search">
          <button type="submit" name="submit" class="btn btn-default col-1"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
    <div id="cetak_ini" class="content">
    <div class="hide">
      <?php 
        include 'headerprint.php';
      ?>
    </div>
    <br>
     <?php
    if ($_SESSION['status'] == 1) {
    ?>
    <div class="col-12" style="padding-top: 20px">
      <h3 class="center hide" align="center" style="padding-bottom: 20px">VIEW BORROWERS</h3>
      <div class="col-1">&nbsp;</div>
      <div class="table-responsive col-10" style="padding-bottom: 20px">
        <table class="table table-striped table-bordered" id="myTable">
          <tr>
            <th>Employee ID</th>
            <th>Employee first name</th>
            <th>Employee last name</th>
            <th>Employee middle name</th>
            <th>Status</th>
              <th class="jangan_cetak" width="13%">Action</th>
          </tr>
          <?php
          
          include "db.php";
          
          $coba = intval($_POST['coba']);
          $search = $_POST['search'];

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

          $_SESSION['coba'] = $coba;
          $_SESSION['search'] = $search;

          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>".$data['employee_id']."</td>";
            echo "<td>".$data['employee_first_name']."</td>";
            echo "<td>".$data['employee_last_name']."</td>";
            echo "<td>".$data['employee_middle_name']."</td>";
            echo "<td>".$data['employee_status']."</td>";
            echo "<td class='jangan_cetak'><a class='btn btn-warning btn-sm' style='padding-right:20px' href='editborrow.php?id=".$data['employee_id']."'>Edit</a><span style='padding-right:10px'>&nbsp</span><a class='btn btn-danger btn-sm' href='deleteborrow.php?id=".$data['employee_id']."'>Delete</a></td>";
          echo "</tr>";
          }
          ?>
        </table>
        <div class="col-12">
          <a href="" id="cetak" class="jangan_cetak btn btn-default"><i class="fa fa-print"></i></a>
          <a href="export-borrow.php" class="btn btn-default"><i class="fa fa-file-excel-o"></i></a>
        </div>
      </div>
    </div>
        <?php } else if($_SESSION['status'] == 2){?> 
        	 <div class="col-12" style="padding-top: 20px">
      <h3 class="center hide" align="center" style="padding-bottom: 20px">VIEW BORROWERS</h3>
      <div class="col-1">&nbsp;</div>
      <div class="table-responsive col-10" style="padding-bottom: 20px">
        <table class="table table-striped table-bordered" id="myTable">
          <tr>
            <th>Employee ID</th>
            <th>Employee first name</th>
            <th>Employee last name</th>
            <th>Employee middle name</th>
            <th>Status</th>
          </tr>
          <?php
          
          include "db.php";
          
          $coba = intval($_POST['coba']);
          $search = $_POST['search'];

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

          $_SESSION['coba'] = $coba;
          $_SESSION['search'] = $search;

          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>".$data['employee_id']."</td>";
            echo "<td>".$data['employee_first_name']."</td>";
            echo "<td>".$data['employee_last_name']."</td>";
            echo "<td>".$data['employee_middle_name']."</td>";
            echo "<td>".$data['employee_status']."</td>";
          echo "</tr>";
          }
          ?>
        </table>
        <div class="col-12">
          <a href="" id="cetak" class="jangan_cetak btn btn-default"><i class="fa fa-print"></i></a>
          <a href="export-borrow.php" class="btn btn-default"><i class="fa fa-file-excel-o"></i></a>
        </div>
      </div>
    </div>
          <?php } ?>
  </div>
  </body>
  <?php
  include "footer.php";
  ?>
  <!--
  <script>
    function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }
    </script>
  -->
  <script>
      
//            membuat fungsi cetak
        $('#cetak').click(function () {
            printDiv('cetak_ini');
        });

//            membuat fungsi print untuk div tertentu
//            fungsi ini akan membuat jendela baru
//            dan menuliskan kembali html ke dalamnya
        function printDiv(divId) {
            var divToPrint = document.getElementById(divId);
            newWin = window.open("", "", "width=800, height=500, scrollbars=yes");
            newWin.document.write('<!doctype html><html><head>');
            newWin.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">');
            newWin.document.write('<style> .jangan_cetak {display:none} table {border-collapse: collapse; text-align: center}  th {width: 200px;} table, th, td {border: 1px solid black;}</style>');
            newWin.document.write('</head><body>');
            newWin.document.write('<div class="content">');
            newWin.document.write(divToPrint.innerHTML);
            newWin.document.write('</div>');
            newWin.document.write('</body>');
            newWin.document.write('</html>');
            newWin.document.close();
            newWin.focus();
            newWin.print();
            newWin.close();
        }
      </script>
</html>