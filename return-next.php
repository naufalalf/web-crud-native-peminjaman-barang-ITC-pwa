<?php
include 'header.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="js/script.js"></script>
    <link rel="stylesheet"  href="select.css">
    <style type="text/css">
    .dlk-radio input[type="radio"],
    .dlk-radio input[type="checkbox"]
    {
    margin-left:-99999px;
    display:none;
    }
    .dlk-radio input[type="radio"] + .fa ,
    .dlk-radio input[type="checkbox"] + .fa {
    opacity:0.15
    }
    .dlk-radio input[type="radio"]:checked + .fa,
    .dlk-radio input[type="checkbox"]:checked + .fa{
    opacity:1
    }
    </style>
  </head>
  <body>
    <?php
    $rb = $_GET['rb'];
    $_SESSION['rb'] = $rb;
    if (isset($_GET['rb'])) {
    ?>
    <form method="get" action="return-next-process.php">
      <div class="col-2">&nbsp;</div>
      <div class="col-8">
        <div class="col-12">
          <div class="col-12" style="padding: 20px">
            <input type="text" onkeyup="myFunction()" class="form-control col-6" id="myInput" placeholder="Search...">
            <br><br><br>
            <div class="table-responsive col-12">
              <table class="table table-striped table-bordered" id="myTable">
                <tr>
                  <th>Property Number</th>
                  <th>Item Name</th>
                  <th>Description</th>
                  <th>Accountable Employee</th>
                  <th style="width: 10%">Select</th>
                </tr>
                <?php
                $sql = mysqli_query($conn, "SELECT * FROM borrowed_equipment, equipment WHERE borrowed_equipment.employee_id = '$rb' AND equipment.property_number = borrowed_equipment.property_number AND borrowed_equipment.date_returned = 00-00-0000");
                while($data = mysqli_fetch_array($sql)){
                ?>
                <tr>
                  <td><?php echo $data['property_number'];?></td>
                  <td><?php echo $data['item_name']; ?></td>
                  <td><?php echo $data['description']; ?></td>
                  <td><?php echo $data['accountable_employee']; ?></td>
                  <td>
                    <div data-toggle="radio-groups" class="dlk-radio btn-group">
                      <label class="btn btn-success">
                        <input class="form-control" required="required" type="radio" value="<?php echo $data['property_number']; ?>" name="id">
                        <i class="fa fa-check glyphicon glyphicon-ok"></i>
                      </label>
                      <div>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </table>
                  <?php echo "<input type='hidden' name='rb' value='".$_GET['rb']."'>" ?>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
              </div>
            </div>
          </form>
      </body>
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
      td0 = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];

      if (td0 || td1 || td2 || td3) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;

        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1)
        {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      } 
      }    
    }
    </script>
    </html>

    <?php } ?>