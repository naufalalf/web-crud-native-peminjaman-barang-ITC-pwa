<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
  <body>
    <h3 align="center" style="padding-bottom: 20px">VIEW USER</h3>
    <div class="col-12">
      <div class="col-1">&nbsp;</div>
      <div class="col-10">
        <form class="col-5" method="post" style="padding-bottom: 10px">
          <select class="col-3 form-control" name="coba" required="">
            <option value="" disabled="" selected="">Field..</option>
            <option value="1">User ID</option>
            <option value="2">Username</option>
          </select>
          <input type="text" class="form-control col-8" placeholder="Search.." name="search">
          <button type="submit" name="submit" class="btn btn-default col-1"><i class="fa fa-search"></i></button>
        </form>
        <div class="col-6">&nbsp;</div>
        <div class="col-1"><a href="adduser.php" class="btn btn-default"><i class="fa fa-plus"></i> ADD USER</a></div>
      </div>
    </div>
    <br>
    <div class="col-12" style="padding-top: 20px">
      <div class="col-1">&nbsp;</div>
      <div class="table-responsive col-10" style="padding-bottom: 20px">
        <table class="table table-striped table-bordered" id="myTable">
          <tr>
            <th>User ID</th>
            <th>Username</th>
            <!-- <th>Password</th> -->
            <th class="jangan_cetak" width="13%">Action</th>
          </tr>
          <?php
          include "db.php";
          
          $coba = intval($_POST['coba']);
          $search = $_POST['search'];

          if ($coba == 1 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$search'");
          }
          else if ($coba == 2 and !empty($search)) {
            $sql = mysqli_query($conn, "SELECT * FROM user WHERE user_user LIKE '$search%'");
          }
          else {
            $sql = mysqli_query($conn, "SELECT * FROM user");
          }

          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>".$data['user_id']."</td>";
            echo "<td>".$data['user_user']."</td>";
            // echo "<td>".$data['user_pass']."</td>";
            echo "<td class='jangan_cetak'><a class='btn btn-warning btn-sm' style='padding-right:20px' href='edituser.php?id=".$data['user_id']."'>Edit</a><span style='padding-right:10px'>&nbsp</span><a class='btn btn-danger btn-sm' href='deleteuser.php?id=".$data['user_id']."'>Delete</a></td>";
          echo "</tr>";
          }
          ?>
        </table>
      </div>
    </div>
  </body>
  <?php
  include "footer.php";
  ?>
</html>