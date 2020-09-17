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
<form action="borrowequip-process.php" method="POST">

  <div class="col-12">

	<div class="col-6">
	   <div class="col-12">
  	 	 <div class="col-12" style="padding: 20px">
     		<input type="text" onkeyup="Function()" class="form-control col-6" id="Inpput" placeholder="Search...">	
       		<br><br><br>
	      	<div class="table-responsive col-12">
	        	<table class="table table-striped table-bordered" id="Tabble">
		          <tr>
		            <th>Employee ID</th>
		            <th>Employee First Name</th>
		            <th>Employee Last Name</th>
				        <th>Employee Middle Name</th>
		            <th style="width: 10%">Select</th>
		          </tr>  
	          <?php
	          $sqlq = mysqli_query($conn, "SELECT * from borrowers");
	          while($dataq = mysqli_fetch_array($sqlq)){
	          	?>
	          <tr>
	          	<td><?php echo $dataq['employee_id'];?></td>
	          	<td><?php echo $dataq['employee_first_name'];?></td>
		      	<td><?php echo $dataq['employee_last_name'];?></td>
	  	      	<td><?php echo $dataq['employee_middle_name'];?></td>
	         	<td>
	         		<div data-toggle='radio-groups' class='dlk-radio btn-group'>
						<label class="btn btn-success">
					        <input class="form-control" type="radio" value="<?php echo $dataq['employee_id']; ?>" name="rb[]">
					        <i class="fa fa-check glyphicon glyphicon-ok"></i>
					   </label>
	         		</div>
	         	</td>
	          </tr>
			<?php
	       	  }
	          ?>
	        </table>
	      </div>
	  </div>
  </div>
</div>
  

  <div class="col-6">
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
		          	<th style="width: 10%">Select</th>
		          </tr>  
		          <?php
		          $sql = mysqli_query($conn, "SELECT * FROM equipment");
		          while($data = mysqli_fetch_array($sql)){
		          	?>
		          	<tr>
		          		<td><?php echo $data['property_number'];?></td> 	
			            <td><?php echo $data['item_name']; ?></td>
			            <td><?php echo $data['description']; ?></td>
		            	<td>
		            		<div data-toggle="buttons" class="dlk-radio btn-group">
		                  		<label class="btn btn-success">
		                  			<input class="form-control" type="checkbox" value="<?php echo $data['property_number']; ?>" name="id[]">
	        						<i class="fa fa-check glyphicon glyphicon-ok"></i>
	        					</label>
		            		<div>
		            	</td>
			        </tr>
			        <?php
			          }
			        ?>
		        </table>
		   	  </div>
	     </div>
	</div>
  </div>

</div>

<div style="padding-bottom: 20px">
	<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</button></center>
</div>
<!--  The Modal -->
  <div class="modal" id="myModal" style="padding-top: 40px">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Borrow Equipment IT Center</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Are you sure with your choice?
        </div>
        
      <!--   Modal footer -->
        <div class="modal-footer">
          	<button type="submit" class="btn btn-default" name="submit" value="submit" >Yes</button>
        </div>
        
      </div>
    </div>
  </div>
 </form>
</body>

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

      if (td0 || td1 ||td2) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;

        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1)
        {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      } 
      }    
    }
    </script>

    <script>
    function Function() {
      // Declare variables 
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("Inpput");
      filter = input.value.toUpperCase();
      table = document.getElementById("Tabble");
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
