<?php
ob_start();
require "../layouts/header.php";
require "../../config/config.php";


//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
  header("location: login-admins.php");
}

// Check if the form is submitted
if (isset($_POST['submit'])) {

  if (empty($_POST['name']) or empty($_POST['description']) or empty($_POST['location'])) {
    echo "<script>alert('one or more inputs are empty')</script>";
  } else {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $image = $_FILES['image']['name'];

    $dir = "hotels_images/" . basename($image);

    $insert = $conn->prepare("INSERT INTO hotels (name, description, location, image)
     VALUES (:name, :description, :location, :image)");

    $insert->execute([
      ":name" => $name,
      ":description" => $description,
      ":location" => $location,
      ":image" => $image
    ]);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
      header("location: show-hotels.php");
    }
  }
}
ob_end_flush();
?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Hotels</h5>
          <form method="POST" action="create-hotels.php" enctype="multipart/form-data">

            <!-- Name input -->
            <div class="form-outline mb-4 mt-4">
            <label for="exampleFormControlTextarea1">Name</label>
              <input type="text" name="name" id="form2Example1" class="form-control"/>
            </div>

            <!-- Image input -->
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control" />
            </div>

            <!-- Description input -->
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <!-- Location input -->
            <div class="form-outline mb-4 mt-4">
              <label for="exampleFormControlTextarea1">Location</label>
              <input type="text" name="location" id="form2Example1" class="form-control" />
            </div>

            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>


          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>