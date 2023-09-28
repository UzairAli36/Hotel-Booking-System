<?php
ob_start();
require "../includes/header.php";
require "../config/config.php";

if (isset($_SESSION['username'])) {
  header("location: " . APPURL . "");
}

if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script>alert('One or more inputs are empty')</script>";
  } else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $insert->execute([
      ":username" => $username,
      ":email" => $email,
      ":password" => $password,
    ]);

    header("location: login.php");
  }
}
ob_end_flush();
?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
      <div class="col-md-7 ftco-animate">
        <!-- <h2 class="subheading">Welcome to Vacation Rental</h2>
          	<h1 class="mb-4">Rent an appartment for your vacation</h1>
            <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row justify-content-middle" style="margin-left: 397px;">
      <div class="col-md-6 mt-5">
        <form action="register.php" method="POST" class="appointment-form" style="margin-top: -568px;">
          <h3 class="mb-3">Register</h3>
          <div class="row">

            <div class="col-md-12">
              <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Username">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <input name="email" type="text" class="form-control" placeholder="Email">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <input name="submit" type="submit" value="Register" class="btn btn-primary py-3 px-4">
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require "../includes/footer.php" ?>