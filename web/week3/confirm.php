<?php include 'common/header.php'; ?>
<?php session_start() ?>
<div class="container">
    <h1>Order Confirmation</h1>
    <hr>
    <h4 class="message">Your Order has been placed!</h4>
    <hr>

    <div class="orderContainer">
    <h4>Items Ordered</h4>
    <?php if (isset($_SESSION['orderInfo'])) {
        echo $_SESSION['orderInfo'];
    };
    ?>
    <hr>
    <h4>Shipping Information</h4>
    <p class="confirmInfo">Name</p>
    <p><?php if (isset($_SESSION['name'])) {
            echo $_SESSION['name'];
        } ?></p>
    <p class="confirmInfo">Address</p>
    <p class='addressInfo'><?php if (isset($_SESSION['address'])) {
            echo $_SESSION['address'];
        } ?></p>
    <p class='addressInfo'><?php if (isset($_SESSION['city'])) {
            echo $_SESSION['city'];
        } ?></p>
    <p class='addressInfo'><?php if (isset($_SESSION['state'])) {
            echo $_SESSION['state'];
        } ?></p>
    <p class='addressInfo'><?php if (isset($_SESSION['zip'])) {
            echo $_SESSION['zip'];
        } ?></p>
    </div>
</div>

<?php include 'common/footer.php'; ?>
<?php session_unset() ?>