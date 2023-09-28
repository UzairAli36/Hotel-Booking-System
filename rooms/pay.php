<?php require "../config/config.php"; ?>
<?php require "../includes/header.php"; ?>
<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    // redirect them to your desired location
    echo "<script>window.location.href='" . APPURL . "' </script>";
    exit;
}

?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container" style="padding-top: 150px;">
        <h2 class="subheading" style="font-family:Playfair Display, serif; font-size: 50px; padding-left: 15px; text-align: center; color:white;">Welcome to Vacation Rental</h2>
        <div class="container mt-5" style="margin-left: 250px;">
            <!-- Replace "test" with your own sandbox Business account app client ID -->
            <script src="https://www.paypal.com/sdk/js?client-id=AQld6OpFp6sMDYIaiFSWrFFzdr_M09tmVT1NBkzAjxTN4LTGKfWCUjPjMFAPsx_Bqi07gaQvpI7cnpLI&currency=USD"></script>
            <!-- Set up a container element for the button -->
            <div id="paypal-button-container"></div>
            <script>
                paypal.Buttons({
                    // Sets up the transaction when a payment button is clicked
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '<?php echo $_SESSION['price']; ?>' // Can also reference a variable or function
                                }
                            }]
                        });
                    },
                    // Finalize the transaction after payer approval
                    onApprove: (data, actions) => {
                        return actions.order.capture().then(function(orderData) {

                            window.location.href = '<?php echo APPURL ?>';
                        });
                    }
                }).render('#paypal-button-container');
            </script>
        </div>
    </div>
</div>




<?php require "../includes/footer.php"; ?>