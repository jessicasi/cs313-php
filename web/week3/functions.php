<?php
//Build Cart Display
function buildCartDisplay($books){

    $db = '<ul class="cart-display">';
    foreach ($books as $book) {
        $book = htmlspecialchars_decode($book,ENT_QUOTES);
        $db .= '<li><p class="col1">';
        $db .= $book;
        $db .= "</p><p class='col2'><a href='cart?action=delete&title=$book'> Remove from Cart</a></p>";
        $db .= '</li>';
    }
    $db .= '</ul>';

    return $db;
}

function buildOrderInfo() {
    $od = '<ul class="order-display">';
    foreach ($_SESSION['cartItems'] as $item){
        $od.= '<li><p>';
        $od.= $item;
        $od.= '</p></li>';
    }
    $od .= '</ul>';
    return $od;

}
