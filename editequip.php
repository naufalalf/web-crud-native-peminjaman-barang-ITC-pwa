<?php
include 'header.php';
include 'db.php';

$id = $_GET['id'];
$query = "SELECT * FROM equipment WHERE property_number = '$id'";
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
                <h3 class="center">EDIT EQUIPMENT</h3>
                <form class="form-horizontal"  action="editequip-process.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Property ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly="" id="property_number" name="property_number" required="required" value="<?php echo($data["property_number"]) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Item Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="item_name" name="item_name"  required="required" value="<?php echo($data["item_name"]) ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Description:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" name="description"  required="required" value="<?php echo($data["description"]) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Date Acquired:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date_acquired" name="date_acquired" required="required" value="<?php echo($data["date_acquired"]) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Accountable Employee:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="accountable_employee" name="accountable_employee"  required="required" value="<?php echo($data["accountable_employee"]) ?>">
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