<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<div class="d-flex align-items-center justify-content-center vh-100" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');">
    <div class="text-center">
        <h1 class="display-1 fw-bold">404</h1>
        <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you’re looking for doesn’t exist.
        </p>
        <a href="<?php echo APPURL; ?>" class="btn btn-primary">Go Home</a>
    </div>
</div>

<?php require "includes/footer.php"; ?>