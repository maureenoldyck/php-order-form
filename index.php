<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// We are going to use session variables so we need to enable sessions
session_set_cookie_params(0);
session_start();

// Global variables 

// if loop to get global variable for total value (if a cookie is set or not)
if (isset($_COOKIE['valueOrders'])) {
    $totalValue = $_COOKIE['valueOrders'];
} else {
    $totalValue = 0;
}

$orderTotal = 0;
$regexNumbersOnly = "/^[0-9]*$/";

// if loop to get variables (if session is set or not)
if ($_SESSION) {
    $email = $_SESSION['email'];
    $street = $_SESSION['street'];
    $streetnumber = $_SESSION['streetnumber'];
    $city = $_SESSION['city'];
    $zipcode = $_SESSION['zipcode'];
} else {
    $email = "";
    $street = "";
    $streetnumber = "";
    $city = "";
    $zipcode = "";
}

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// Toggle to different products
if (empty($_GET) || $_GET['air'] == 0) {
    $products = [
        ['name' => 'Healthy Mountain Air', 'price' => 25],
        ['name' => 'Healthy Forest Air', 'price' => 20],
        ['name' => 'Healthy Ocean Air', 'price' => 15],
        ['name' => 'Mysterious Air', 'price' => 22.5],
        ['name' => 'The Air after it Rained', 'price' => 8.5],
        ['name' => 'The Air of a Sunny Day', 'price' => 20],
        ['name' => 'Air from the North Sea', 'price' => 5.5],
        ['name' => 'Air from the Bahamas', 'price' => 50],
        ['name' => 'Air from Ninove', 'price' => 2.5],
        ['name' => 'Smoke', 'price' => 2.5],
    ];
} else if (($_GET['air']) == 1) {
    $products = [
        ['name' => 'Healthy Mountain Water', 'price' => 25],
        ['name' => 'Healthy Forest Water', 'price' => 20],
        ['name' => 'Healthy Ocean Water', 'price' => 15],
        ['name' => 'Mysterious Water', 'price' => 22.5],
        ['name' => 'Rain Water', 'price' => 8.5],
        ['name' => 'The Water of a Sunny Day', 'price' => 20],
        ['name' => 'Water from the North Sea', 'price' => 5.5],
        ['name' => 'Water from the Bahamas', 'price' => 50],
        ['name' => 'Water from Ninove', 'price' => 2.5],
        ['name' => 'Polluted water', 'price' => 2.5],
    ];
} 


// TODO: Refactor in seperate functions
 
if (isset($_POST['submit'])) {

    $email = $_SESSION['email'] = $_POST['email'];
    $street = $_SESSION['street'] = $_POST['street'];
    $streetnumber = $_SESSION['streetnumber'] = $_POST['streetnumber'];
    $city = $_SESSION['city'] = $_POST['city'];
    $zipcode = $_SESSION['zipcode'] = $_POST['zipcode'];

    // Validation required fields
    if (!empty($email) && !empty($street) && !empty($streetnumber) && !empty($city) && !empty($zipcode) && isset($_POST['products'])) {

        // Validate zipcode
        if (!preg_match($regexNumbersOnly, $zipcode)) {

            $zipcode = "";
            echo '<div class="alert alert-warning" role="alert"> Please enter a valid zipcode! (Only numbers allowed)  </div>';

            // Validate email
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $email = "";
            echo '<div class="alert alert-warning" role="alert"> Invalid email format, please enter a valid email. </div>';

            // When everthing is filled in correct
        } else {

            //Order confirmation 

            echo '<div class="alert alert-success" role="alert"> <h3> Thank you for your order! </h3> <hr> <h4 class="alert-heading"> Order confirmtation </h4> <b> You\'ve ordered: </b> </br> <p>';

            foreach ($_POST['products'] as $i => $product) {
                // Specify the quanity of the ordered products
                $quantity = $_POST['quantity'][$i];
                echo $products[$i]['name'] . ' - € ' . $products[$i]['price'] . ' - Quantity : ' . $quantity .'</br>';
                $orderTotal += ($products[$i]['price']) * $quantity;
            }

            echo '<b> Order total: </b> €' . $orderTotal . '</br> To: ' . $street . ' ' . $streetnumber . ', ' . $city . ' ' .  $zipcode . "</p> </div>";

            //If cookie is not created create cookie for total order value of site --> to fill in totalvalue in footer
            if (!isset($_COOKIE['valueOrders'])) {
                setcookie('valueOrders', strval($totalValue), time() + (86400 * 365), "/");
                $totalValue = $_COOKIE['valueOrders'];
                $totalValue += $orderTotal;
            } else {
                $totalValue += $orderTotal;
                setcookie('valueOrders', strval($totalValue), time() + (86400 * 365), "/");
            }
        }

        // Error when user didn't select any products
    } else if (!isset($_POST['products'])) {

        echo '<div class="alert alert-warning" role="alert"> Please select the products you want to buy! </div>';

        // Error when fields are not filled in
    } else {

        echo '<div class="alert alert-warning" role="alert"> Please fill in all required fields!  </div>';
    }
}


require 'form-view.php';

