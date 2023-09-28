<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}


// Products
$hotels = $conn->query("SELECT COUNT(*) AS count_hotels FROM hotels");
$hotels->execute();

$hotelsCount = $hotels->fetch(PDO::FETCH_OBJ);

// Orders
$rooms = $conn->query("SELECT COUNT(*) AS count_rooms FROM rooms");
$rooms->execute();

$roomsCount = $rooms->fetch(PDO::FETCH_OBJ);

// Admins
$admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
$admins->execute();

$adminsCount = $admins->fetch(PDO::FETCH_OBJ);

?>

<div class="container-fluid">

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Hotels</h5>
          <p class="card-text">number of hotels: <?php echo $hotelsCount->count_hotels; ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rooms</h5>
          <p class="card-text">number of rooms: <?php echo $roomsCount->count_rooms; ?></p>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Admins</h5>
          <p class="card-text">number of admins: <?php echo $adminsCount->count_admins; ?></p>

        </div>
      </div>
    </div>
  </div>

</div>

<?php require "layouts/footer.php"; ?>