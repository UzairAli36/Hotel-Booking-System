<?php
ob_start();

require "../layouts/header.php";
require "../../config/config.php";

//  Redirect user to login page if not signed in
if (!isset($_SESSION['admin_name'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

// Displaying all Bookings
$bookings = $conn->query("SELECT * FROM bookings");
$bookings->execute();

$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);

ob_end_flush();
?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Bookings</h5>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Check in</th>
                <th scope="col">Check out</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Full Name</th>
                <th scope="col">Hotel Name</th>
                <th scope="col">Room Name</th>
                <th scope="col">Payment</th>
                <th scope="col">Status</th>
                <th scope="col">Change Status</th>
                <th scope="col">Delete</th>
                <th scope="col">Created</th>
              </tr>
            </thead>
            <?php foreach ($allBookings as $booking) : ?>
              <tbody>
                <tr>
                  <th scope="row"><?php echo $booking->id; ?></th>
                  <td><?php echo $booking->check_in; ?></td>
                  <td><?php echo $booking->check_out; ?></td>
                  <td><?php echo $booking->email; ?></td>
                  <td><?php echo $booking->phone_number; ?></td>
                  <td><?php echo $booking->full_name; ?></td>
                  <td><?php echo $booking->hotel_name; ?></td>
                  <td><?php echo $booking->room_name; ?></td>
                  <td>$<?php echo $booking->payment; ?></td>
                  <td><?php echo $booking->status; ?></td>
                  <td><a href="status-bookings.php?id=<?php echo $booking->id; ?>" class="btn btn-warning text-white text-center ">Change Status</a></td>
                  <td><a href="delete-bookings.php?id=<?php echo $booking->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                  <td><?php echo $booking->created_at; ?></td>
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