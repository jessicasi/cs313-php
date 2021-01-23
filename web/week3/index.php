<?php

//This is the main controller

//Create or access a Session
session_start();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    default:
    include 'shop.php';
        break;
}

unset($_SESSION['message']);