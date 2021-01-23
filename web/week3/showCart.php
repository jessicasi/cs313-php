<?php include 'common/header.php'; ?>
<?php
session_start(); ?>

<div class="container">
    <h1>Shopping Cart</h1>
    <hr>
    <?php if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    };
    ?>
    <?php if (isset($_SESSION['cartDisplay'])) {
        echo $_SESSION['cartDisplay'];
    };
    ?>
    <p class="checkoutButtons">
        <a href="week3" class="btn btn-primary" id="continue">Continue Shopping</a>
        <a href="cart?action=deliverCheckoutView" class="btn btn-primary" id="chkout">Check Out</a>
    </p>
</div>


<?php include 'common/footer.php'; ?>
<?php unset($_SESSION['message']); ?>