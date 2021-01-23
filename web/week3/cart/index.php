<?php
//Cart controller

session_start();

require_once '../functions.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

//initiate session array

switch ($action) {

    case 'add':
        //store incoming item
    
        $itemName = filter_input(INPUT_GET, 'itemName', FILTER_SANITIZE_STRING);

        $itemName = htmlspecialchars($itemName);

        if (!in_array($itemName, $_SESSION['cartItems'])) {

            $_SESSION['cartItems'][] = $itemName;
        }
        header('Location: ../index.php');
        break;

    case 'showCart':

        if (isset($_SESSION['cartItems'])) {
            $_SESSION['cartDisplay'] = buildCartDisplay($_SESSION['cartItems']);
        } else {
            $_SESSION['message'] = '<p class="message">Your cart is currently empty</p>';
        }


        header('Location: ../showCart.php');
        break;

    case 'delete':
        $book = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING);
        $book = htmlspecialchars($book);

        if (in_array($book, $_SESSION['cartItems'])) {
            $_SESSION['cartItems'] = \array_diff($_SESSION['cartItems'], [$book]);
        }
        //rebuild lits
        $_SESSION['cartDisplay'] = buildCartDisplay($_SESSION['cartItems']);

        if (empty($_SESSION['cartItems'])) {
            unset($_SESSION['cartDisplay']);
            unset($_SESSION['cartItems']);
            $_SESSION['message'] = '<p class="message">Your cart is currently empty</p>';
        }


        header('Location: ../showCart.php');
        break;

        break;

    case 'deliverCheckoutView':
        if (empty($_SESSION['cartItems'])) {
            $_SESSION['message'] = '<p class="errorMessage">Add something to your cart before you can checkout</p>';
            header('Location: /web/week3/showCart.php');
            exit;
        }
        header('Location: ../checkout.php');
        break;

    case 'checkout':
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_NUMBER_INT);

        $_SESSION['name'] = htmlspecialchars($name);
        $_SESSION['address'] = htmlspecialchars($address);
        $_SESSION['city'] = htmlspecialchars($city);
        $_SESSION['state'] = htmlspecialchars($state);
        $_SESSION['zip'] = htmlspecialchars($zip);

        

        $_SESSION['orderInfo'] = buildOrderInfo();

        header('Location: ../confirm.php');

        break;


    default:
        header('Location: ../shop.php');
        break;
}
