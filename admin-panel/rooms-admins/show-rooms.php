<?php
ob_start();

require "../layouts/header.php";
require "../../config/config.php";

//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

// Displaying all Rooms
$rooms = $conn->query("SELECT * FROM rooms");
$rooms->execute();

$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);

ob_end_flush();
?>

<div class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Rooms</h5>
          <a href="create-rooms.php" class="btn btn-primary mb-4 text-center float-right">Add Rooms</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Persons</th>
                <th scope="col">Size</th>
                <th scope="col">View</th>
                <th scope="col">Beds</th>
                <th scope="col">Hotel Name</th>
                <th scope="col">Status</th>
                <th scope="col">Change Status</th>
                <th scope="col">Delete</th>
                <th scope="col">Created</th>
              </tr>
            </thead>
            <?php foreach ($allRooms as $room) : ?>
            <tbody>
              <tr>
                <th scope="row"><?php echo $room->id; ?></th>
                <td><?php echo $room->name; ?></td>
                <td><img src="../../images/<?php echo $room->image; ?>" style="width: 60px; height: 60px;"></td>
                <td>$<?php echo $room->price; ?></td>
                <td><?php echo $room->num_persons; ?></td>
                <td><?php echo $room->size; ?>m2</td>
                <td><?php echo $room->view; ?></td>
                <td><?php echo $room->num_beds; ?></td>
                <td><?php echo $room->hotel_name; ?></td>
                <td><?php echo $room->status; ?></td>
                
                <td><a href="status-rooms.php?id=<?php echo $room->id; ?>" class="btn btn-warning  text-center ">Change Status</a></td>
                <td><a href="delete-rooms.php?id=<?php echo $room->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                <td><?php echo $room->created_at; ?></td>
              </tr>

            </tbody>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>



</div>

<?php require "../layouts/footer.php"; ?>