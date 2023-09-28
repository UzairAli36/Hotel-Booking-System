<?php
ob_start();

require "../layouts/header.php";
require "../../config/config.php";

//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

// Displaying all Hotels
$hotels = $conn->query("SELECT * FROM hotels");
$hotels->execute();

$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

ob_end_flush();
?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Hotels</h5>
          <a href="create-hotels.php" class="btn btn-primary mb-4 text-center float-right">Add Hotels</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Location</th>
                <th scope="col">Status Value</th>
                <th scope="col">Change Status</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <?php foreach ($allHotels as $hotel) : ?>
              <tbody>
                <tr>
                  <th scope="row"><?php echo $hotel->id; ?></th>
                  <td><?php echo $hotel->name; ?></td>
                  <td><img src="../../images/<?php echo $hotel->image; ?>" style="width: 60px; height: 60px;"></td>
                  <td><?php echo $hotel->location; ?></td>
                  <td><?php echo $hotel->status; ?></td>

                  <td><a href="status-hotels.php?id=<?php echo $hotel->id; ?>" class="btn btn-warning text-white text-center ">Change Status</a></td>
                  <td><a href="update-hotels.php?id=<?php echo $hotel->id; ?>" class="btn btn-warning text-white text-center ">Update </a></td>
                  <td><a href="delete-hotels.php?id=<?php echo $hotel->id; ?>" class="btn btn-danger  text-center ">Delete </a></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>