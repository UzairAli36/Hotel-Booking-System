<?php
ob_start();

require "../includes/header.php";
require "../config/config.php";

if (!isset($_SESSION['username'])) {
    echo "<script>window.location.href='" . APPURL . "'</script>";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SESSION['id'] != $id) {
        echo "<script>window.location.href='" . APPURL . "'</script>";
    }

    $bookings = $conn->query("SELECT * FROM bookings WHERE user_id = '$id'");
    $bookings->execute();

    $allbookings = $bookings->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "<script>window.location.href='" . APPURL . "/404.php'</script>";
}

ob_end_flush();
?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home <i class="fa fa-chevron-right"></i></a></span> <span>Rooms <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Your Bookings</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <?php if (count($allbookings) > 0) : ?>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">Check-in</th>
                    <th scope="col">Check-out</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Hotel Name</th>
                    <th scope="col">Room</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allbookings as $booking) : ?>
                    <tr>
                        <td><?php echo $booking->check_in ?></td>
                        <td><?php echo $booking->check_out ?></td>
                        <td><?php echo $booking->email ?></td>
                        <td><?php echo $booking->phone_number ?></td>
                        <td><?php echo $booking->full_name ?></td>
                        <td><?php echo $booking->hotel_name ?></td>
                        <td><?php echo $booking->room_name ?></td>
                        <td><?php echo $booking->status ?></td>
                        <td>$<?php echo $booking->payment ?></td>
                        <td><?php echo $booking->created_at ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <br>
        <div class="alert alert-primary" role="alert">
            You do not have any bookings for now.
        </div>
    <?php endif; ?>
</div>

<?php require "../includes/footer.php"; ?>