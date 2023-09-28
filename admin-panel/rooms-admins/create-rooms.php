<?php
ob_start();
require "../layouts/header.php";
require "../../config/config.php";


//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
  header("location: login-admins.php");
}

$hotels = $conn->query("SELECT * FROM hotels");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

// Check if the form is submitted
if (isset($_POST['submit'])) {

  if (
    empty($_POST['name']) || empty($_POST['price']) || empty($_POST['num_persons']) ||
    empty($_POST['num_beds']) || empty($_POST['size']) || empty($_POST['view']) ||
    empty($_POST['hotel_name']) || empty($_POST['hotel_id'])
  ) {
    echo "<script>alert('one or more inputs are empty')</script>";
  } else {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $num_persons = $_POST['num_persons'];
    $num_beds = $_POST['num_beds'];
    $size = $_POST['size'];
    $view = $_POST['view'];
    $hotel_name = $_POST['hotel_name'];
    $hotel_id = $_POST['hotel_id'];
    $image = $_FILES['image']['name'];

    $dir = "rooms_images/" . basename($image);

    $insert = $conn->prepare("INSERT INTO rooms (name, price, num_persons, num_beds, size, view, hotel_name, hotel_id, image)
     VALUES (:name, :price, :num_persons, :num_beds, :size, :view, :hotel_name, :hotel_id, :image)");

    $insert->execute([
      ":name" => $name,
      ":price" => $price,
      ":num_persons" => $num_persons,
      ":num_beds" => $num_beds,
      ":size" => $size,
      ":view" => $view,
      ":hotel_name" => $hotel_name,
      ":hotel_id" => $hotel_id,
      ":image" => $image
    ]);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
      header("location: show-rooms.php");
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
          <h5 class="card-title mb-5 d-inline">Create Rooms</h5>
          <form method="POST" action="create-rooms.php" enctype="multipart/form-data">

            <!-- Name input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Room Name" />
            </div>

            <!-- Image input -->
            <div class="form-outline mb-4 mt-4">
              <input type="file" name="image" id="form2Example1" class="form-control" />
            </div>

            <!-- Price input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="price" id="form2Example1" class="form-control" placeholder="Price" />
            </div>

            <!-- Persons input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="num_persons" id="form2Example1" class="form-control" placeholder="Number of Persons" />
            </div>

            <!-- Beds input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="num_beds" id="form2Example1" class="form-control" placeholder="Number of Beds" />
            </div>

            <!-- Size input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="size" id="form2Example1" class="form-control" placeholder="Size" />
            </div>

            <!-- View input -->
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="view" id="form2Example1" class="form-control" placeholder="View" />
            </div>

            <!-- Hotel Name input -->
            <label for="exampleFormControlTextarea1">Hotel Name</label>
            <select name="hotel_name" class="form-control">
              <option></option>
              <?php foreach ($allHotels as $hotel) : ?>
                <option value="<?php echo $hotel->name; ?>"><?php echo $hotel->name; ?></option>
              <?php endforeach; ?>
            </select>
            <br>

            <!-- Hotel ID input -->
            <label for="exampleFormControlTextarea1">Hotel ID</label>
            <select name="hotel_id" class="form-control">
              <option></option>
              <?php foreach ($allHotels as $hotel) : ?>
                <option value="<?php echo $hotel->id; ?>"><?php echo $hotel->name; ?></option>
              <?php endforeach; ?>
            </select>
            <br>

            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>


          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>