<?php
ob_start();
require "../layouts/header.php";
require "../../config/config.php";


//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
  header("location: login-admins.php");
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  if (isset($_POST['submit'])) {
    if (empty($_POST['status'])) {
      echo "<script>alert('Select the option')</script>";
    } else {

      $status = $_POST['status'];

      $update = $conn->prepare("UPDATE rooms SET status = :status WHERE id = '$id'");
      $update->execute([
        ":status" => $status
      ]);

      header("location: show-rooms.php");
    }
  }
}
ob_flush();
?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Update Status</h5>
          <form method="POST" action="status-rooms.php?id=<?php echo $id; ?>" enctype="multipart/form-data">

            <!-- Change Status input -->
            <select name="status" style="margin-top: 15px;" class="form-control">
              <option></option>
              <option value="1">Available</option>
              <option value="2">Not Available</option>
            </select>

            <!-- Submit button -->
            <button style="margin-top: 10px;" type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>