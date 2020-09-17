<?php
include 'header.php';
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <body>
    <h3 class="center" style="padding-bottom: 20px">VIEW BORROWED EQUIPMENT</h3>
    <div class="col-12">
      <div class="col-1">&nbsp;</div>
      <div class="col-10">
        <form class="col-5" method="post">
          <select class="col-3 form-control" name="coba" required="">
            <option value="" disabled="" selected="">Field..</option>
            <option value="1">Item Name</option>
            <option value="2">Employee Name</option>
            <option value="3">Status</option>
          </select>
          <input type="text" class="form-control col-8" name="search" placeholder="Search...">
          <button type="submit" name="submit" class="btn btn-default col-1"><i class="fa fa-search"></i></button>   
        </form>
        <p class="col-1">&nbsp;</p>
        <form class="col-6" method="post">
          <select class="col-2 form-control" name="tgl" required="">
            <option value="" disabled="" selected="">Field..</option>
            <option value="1">Date Borrowed</option>
            <option value="2">Date Returned</option>
          </select>
          <input type="date" name="fromdate" class="form-control col-4" required="">
          <p class="col-1" style="padding: 7px">To:</p>
          <input type="date" name="todate" class="form-control col-4" required="">
          <button type="submit" name="date" class="btn btn-default col-1"><i class="fa fa-search"></i></button>
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
    <div class="col-12" style="padding-top: 20px">
      <h3 class="center hide" align="center" style="padding-bottom: 20px">VIEW BORROWED EQUIPMENT</h3>
      <div class="col-1">&nbsp;</div>
      <div class="table-responsive col-10"  style="padding-bottom: 20px">
        <table class="table table-striped table-bordered tabelcetak" id="myTable">
          <tr>
            <th>Item Name</th>
            <th>Employee Name</th>
            <th>Date Borrowed</th>
            <th>Date Returned</th>
            <th>Status</th>
          </tr>
          <?php

          $tgl = intval($_POST['tgl']);
          $coba = intval($_POST['coba']);
          $search = $_POST['search'];

          $fromdate = $_POST['fromdate'];
          $todate = $_POST['todate'];

          if ($tgl == 1 and !empty($fromdate) and !empty($todate)) {
            $sql = mysqli_query($conn, "SELECT * FROM borrowed_equipment, equipment, borrowers WHERE date_borrowed BETWEEN '$fromdate' AND '$todate' and equipment.property_number = borrowed_equipment.property_number and borrowers.employee_id = borrowed_equipment.employee_id");
          }
          else if ($tgl == 2 and !empty($fromdate) and !empty($todate)) {
            $sql = mysqli_query($conn, "SELECT * FROM borrowed_equipment, equipment, borrowers WHERE date_returned BETWEEN '$fromdate' AND '$todate' and equipment.property_number = borrowed_equipment.property_number and borrowers.employee_id = borrowed_equipment.employee_id");
          }
          else if ($coba == 1 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment, borrowed_equipment, borrowers WHERE equipment.property_number = borrowed_equipment.property_number and borrowers.employee_id = borrowed_equipment.employee_id and item_name LIKE '$search%'");
          }
          else if ($coba == 2 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment, borrowed_equipment, borrowers WHERE equipment.property_number = borrowed_equipment.property_number and borrowers.employee_id = borrowed_equipment.employee_id and employee_first_name LIKE '$search%'");
          }
          else if ($coba == 3 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment, borrowed_equipment, borrowers WHERE equipment.property_number = borrowed_equipment.property_number and borrowers.employee_id = borrowed_equipment.employee_id and status LIKE '$search%'");
          }
          else {
            $sql = mysqli_query($conn, "SELECT * FROM equipment, borrowed_equipment, borrowers WHERE equipment.property_number = borrowed_equipment.property_number and borrowers.employee_id = borrowed_equipment.employee_id ORDER BY borrowed_equipment.date_borrowed DESC ,borrowed_equipment.date_returned = 00-00-0000 DESC");
            //$sql = mysqli_query($conn, "SELECT * FROM borrowed_equipment");
          }

          $_SESSION['tgl'] = $tgl;
          $_SESSION['fromdate'] = $fromdate;
          $_SESSION['todate'] = $todate;
          $_SESSION['coba'] = $coba;
          $_SESSION['search'] = $search;

          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>".$data['item_name']."</td>";
            echo "<td>".$data['employee_first_name']."</td>";
            echo "<td>".$data['date_borrowed']."</td>";
            echo "<td>".$data['date_returned']."</td>";
            echo "<td>".$data['status']."</td>";
          echo "</tr>";
          }
          ?>
        </table>
        <div class="col-12">
          <a href="" id="cetak" class="jangan_cetak btn btn-default"><i class="fa fa-print"></i></a>
          <a href="export-borrowed.php" class="btn btn-default"><i class="fa fa-file-excel-o"></i></a>
        </div>

      </div>
    </div>
    <?php
    include "footer.php";
    ?>
    </body>
    <!-- <script>
    function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
      td0 = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td4 = tr[i].getElementsByTagName("td")[4];
      if (td0 || td1 || td2 || td4) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue4 = td4.textContent || td4.innerText;
        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      } 
      }    
    }
    </script> -->
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