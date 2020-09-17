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

<form method="get" action="return-next.php">

  <div class="col-12">
  <div class="col-2">&nbsp;</div>
	<div class="col-8">
	   <div class="col-12">
  	 	 <div class="col-12" style="padding: 20px">
     		<input type="text" onkeyup="myFunction()" class="form-control col-6" id="myInput" placeholder="Search...">	
       		<br><br><br>
	      	<div class="table-responsive col-12">
	        	<table class="table table-striped table-bordered" id="myTable">
		          <tr>
		            <th>Employee ID</th>
		            <th>Employee First Name</th>
		            <th>Employee Last Name</th>
				        <th>Employee Middle Name</th>
                <th>Employee Status</th>
		            <th style="width: 6%">Select</th>
		          </tr>  
	          <?php
	          $sqlq = mysqli_query($conn, "SELECT * FROM borrowers, borrowed_equipment WHERE borrowers.employee_id = borrowed_equipment.employee_id AND borrowed_equipment.date_returned = 00-00-0000 GROUP BY borrowers.employee_id");
	          while($dataq = mysqli_fetch_array($sqlq)){
	          	?>
	          <tr>
	          	<td><?php echo $dataq['employee_id'];?></td>
	          	<td><?php echo $dataq['employee_first_name'];?></td>
              <td><?php echo $dataq['employee_last_name'];?></td>
	  	      	<td><?php echo $dataq['employee_middle_name'];?></td>
              <td><?php echo $dataq['employee_status'];?></td>
	         	<td>
	         		<div data-toggle='radio-groups' class='dlk-radio btn-group'>
						      <label class="btn btn-success">
					        <input required class="form-control" type="radio" value="<?php echo $dataq['employee_id']; ?>" name="rb">
					        <i class="fa fa-check glyphicon glyphicon-ok"></i>
					   </label>
	         		</div>
	         	</td>
	          </tr>
            <?php } ?>
	        </table>
	      </div>
        <button type="submit" class="btn btn-primary">Submit</button>
	  </div>
  </div>
</div>
</form>
  
<?php
    include "footer.php";
?>

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
      td4 = tr[i].getElementsByTagName("td")[4];

      if (td0 || td1 || td2 || td3 || td4) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;

        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1)
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
