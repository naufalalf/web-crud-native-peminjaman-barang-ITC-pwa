<?php
include 'header.php';
include 'db.php';

$id = $_GET['id'];
$query = "SELECT * FROM borrowers WHERE employee_id = '$id'";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);
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
                <h3 class="center">EDIT BORROWERS</h3>
                <form class="form-horizontal"  action="editborrow-process.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Employee ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly="" id="employee_id" name="employee_id" required="required" value="<?php echo($data["employee_id"]) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Employee First Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_first_name" name="employee_first_name"  required="required" value="<?php echo($data["employee_first_name"]) ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Employee Last Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_last_name" name="employee_last_name"  required="required" value="<?php echo($data["employee_last_name"]) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Employee Middle Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_middle_name" name="employee_middle_name" required="required" value="<?php echo($data["employee_middle_name"]) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Status:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="employee_status" name="employee_status"  required="required" value="<?php echo($data["employee_status"]) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>

    <!-- <add data excel to database> -->
    
        </div>
    </div>
</body>

<?php
include 'footer.php';
?>
</html>