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

  $hotel = $conn->query("SELECT * FROM hotels WHERE id = '$id'");
  $hotel->execute();

  $hotelSingle = $hotel->fetch(PDO::FETCH_OBJ);

  if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['location'])) {
      echo "<script>alert('One or more inputs are empty')</script>";
    } else {

      $name = $_POST['name'];
      $description = $_POST['description'];
      $location = $_POST['location'];
      $image = $_FILES['image']['name'];

      $update = $conn->prepare("UPDATE hotels SET name = :name, description = :description, location = :location WHERE id = '$id'");
      $update->execute([
        ":name" => $name,
        ":description" => $description,
        ":location" => $location,
      ]);

      header("location: show-hotels.php");
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
          <h5 class="card-title mb-5 d-inline">Update Hotel</h5>

          <form method="POST" action="update-hotels.php?id=<?php echo $id; ?>">

            <!-- Name input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" value="<?php echo $hotelSingle->name; ?>" name="name" id="form2Example1" class="form-control" placeholder="name" />
            </div>

            <!-- Description input -->
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $hotelSingle->description; ?></textarea>
            </div>

            <!-- Location input -->
            <div class="form-outline mb-4 mt-4">
              <label for="exampleFormControlTextarea1">Location</label>
              <input value="<?php echo $hotelSingle->location; ?>" type="text" name="location" id="form2Example1" class="form-control" />
            </div>

            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>