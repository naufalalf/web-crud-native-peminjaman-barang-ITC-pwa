<?php
include 'header.php';
include 'db.php';
session_start();
 ob_start();
?>
<!DOCTYPE html>
<html lang="en">  
  <body>
    <h3 class="center" style="padding-bottom: 20px">VIEW EQUIPMENT</h3>
    <div class="col-12">
      <div class="col-1">&nbsp;</div>
      <div class="col-10">
        <form class="col-5" method="post">
          <select class="col-3 form-control" name="coba" required="">
            <option value="" disabled="" selected="">Field..</option>
            <option value="1">Property Number</option>
            <option value="2">Item Name</option>
            <option value="3">Description</option>
            <option value="4">Account Employee</option>
          </select>
          <input type="text" class="form-control col-8" name="search" placeholder="Search...">
          <button type="submit" name="submit" class="btn btn-default col-1"><i class="fa fa-search"></i></button>   
        </form>
        <p class="col-2">&nbsp;</p>
        <form class="col-5" method="post">
          <input type="date" name="fromdate" class="form-control col-5" required="">
          <p class="col-1" style="padding: 7px">To:</p>
          <input type="date" name="todate" class="form-control col-5" required="">
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
    <?php
    if ($_SESSION['status'] == 1) {
    ?>
    <div class="col-12" style="padding-top: 20px">
      <h3 class="center hide" align="center" style="padding-bottom: 20px">VIEW EQUIPMENT</h3>
      <div class="col-1">&nbsp;</div>
      <div class="table-responsive col-10"  style="padding-bottom: 20px">
        <table class="table table-striped table-bordered" id="myTable">
          <tr>
            <th><center>Property<br>Number</center></th>
            <th><center>Item Name</center></th>
            <th><center>Description Item</center></th>
            <th><center>Date Acquired</center></th>
            <th><center>Accountable<br>Employee</center></th>
            <th class="jangan_cetak" width="13%"><center>Action</center></th>
          </tr>
          <?php

          $coba = intval($_POST['coba']);
          $search = $_POST['search'];

          $fromdate = $_POST['fromdate'];
          $todate = $_POST['todate'];

          if (!empty($fromdate) and !empty($todate)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE (date_acquired BETWEEN '$fromdate' AND '$todate')");
          }
          else if ($coba == 1 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE property_number = '$search'");
          }
          else if ($coba == 2 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE item_name LIKE '$search%'");
          }
          else if ($coba == 3 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE description LIKE '$search%'");
          }
          else if ($coba == 4 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE accountable_employee LIKE '$search%'");
          }
          else {
            $sql = mysqli_query($conn, "SELECT * FROM equipment");
          }

          $_SESSION['fromdate'] = $fromdate;
          $_SESSION['todate'] = $todate;
          $_SESSION['coba'] = $coba;
          $_SESSION['search'] = $search;

          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>"."<center>".$data['property_number']."</center>"."</td>";
            echo "<td>"."<center>".$data['item_name']."</center>"."</td>";
            echo "<td>"."<center>".$data['description']."</center>"."</td>";
            echo "<td>"."<center>".$data['date_acquired']."</center>"."</td>";
            echo "<td>"."<center>".$data['accountable_employee']."</center>"."</td>";
            echo "<td class='jangan_cetak'><a class='btn btn-warning btn-sm' style='padding-right:20px' href='editequip.php?id=".$data['property_number']."'>Edit</a><span style='padding-right:10px'>&nbsp</span><a class='btn btn-danger btn-sm' href='deleteequip.php?id=".$data['property_number']."'>Delete</a>"."</td>";
          echo "</tr>";
          }
          ?>
        </table>
        <div class="col-12">
          <a href="" id="cetak" class="jangan_cetak btn btn-default"><i class="fa fa-print"></i></a>
          <a href="export-equipment.php" class="btn btn-default"><i class="fa fa-file-excel-o"></i></a>
        </div>
      </div>
      </div>

      <?php } else if($_SESSION['status'] == 2){?> 
      
    <div class="col-12" style="padding-top: 20px">
      <h3 class="center hide" align="center" style="padding-bottom: 20px">VIEW EQUIPMENT</h3>
      <div class="col-1">&nbsp;</div>
      <div class="table-responsive col-10"  style="padding-bottom: 20px">
        <table class="table table-striped table-bordered" id="myTable">
          <tr>
            <th>Property Number</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Date Acquired</th>
            <th>Accountable Employee</th>
  <!--           <th class="jangan_cetak" width="11%">Action</th> -->
          </tr>
          <?php

          $coba = intval($_POST['coba']);
          $search = $_POST['search'];

          $fromdate = $_POST['fromdate'];
          $todate = $_POST['todate'];

          if (!empty($fromdate) and !empty($todate)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE (date_acquired BETWEEN '$fromdate' AND '$todate')");
          }
          else if ($coba == 1 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE property_number = '$search'");
          }
          else if ($coba == 2 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE item_name LIKE '$search%'");
          }
          else if ($coba == 3 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE description LIKE '$search%'");
          }
          else if ($coba == 4 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM equipment WHERE accountable_employee LIKE '$search%'");
          }
          else {
            $sql = mysqli_query($conn, "SELECT * FROM equipment");
          }

          $_SESSION['fromdate'] = $fromdate;
          $_SESSION['todate'] = $todate;
          $_SESSION['coba'] = $coba;
          $_SESSION['search'] = $search;

          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>".$data['property_number']."</td>";
            echo "<td>".$data['item_name']."</td>";
            echo "<td>".$data['description']."</td>";
            echo "<td>".$data['date_acquired']."</td>";
            echo "<td>".$data['accountable_employee']."</td>";
            // echo "<td class='jangan_cetak'><a class='btn btn-warning btn-sm' style='padding-right:20px' href='editequip.php?id=".$data['property_number']."'>Edit</a><span style='padding-right:10px'>&nbsp</span><a class='btn btn-danger btn-sm' href='deleteequip.php?id=".$data['property_number']."'>Delete</a></td>";
          echo "</tr>";
          }
          ?>
        </table>
        <div class="col-12">
          <a href="" id="cetak" class="jangan_cetak btn btn-default"><i class="fa fa-print"></i></a>
          <a href="export-equipment.php" class="btn btn-default"><i class="fa fa-file-excel-o"></i></a>
        </div>
      </div>
      </div>
      <?php } ?>
    </div>
  </div>
    </body>
    <?php
    include "footer.php";
    ?>
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