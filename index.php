<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// We are going to use session variables so we need to enable sessions
session_start();
$_SESSION['email'] = "";
$_SESSION['street'] = "";
$_SESSION['streetnumber'] = "";
$_SESSION['city'] = "";
$_SESSION['zipcode'] = "";

// Global variables 
$totalValue = 0;


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


// TODO: Check out the possibilities of the PHP session and cookies.
// TODO: We want to prefill the address (after the first usage), as long as the browser isn't closed. Which of these techniques is the better choice here?
// TODO: When using cookies on a live site, check any legal requirements.
// TODO: Refactor in seperate functions
// TODO: Read about get variables and what you can do with it.
// TODO: Find commented navigation and activate it. Tweak the content for your own store.
// TODO: Make a second category of products, and provide a new array for this info.
// TODO: The navigation should work as a toggle to switch between the two categories of products.

if (isset($_POST['submit'])) {

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['street'] = $_POST['street'];
    $_SESSION['streetnumber'] = $_POST['streetnumber'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['zipcode'] = $_POST['zipcode'];

    // Validation required fields
    if (!empty($_POST['street']) && !empty($_POST['streetnumber']) && !empty($_POST['city']) && !empty($_POST['zipcode']) && !empty($_POST['email']) && isset($_POST['products'])) {

        $zipcode = $_POST['zipcode'];
        $regexNumbersOnly = "/^[0-9]*$/";
        $email = $_POST['email'];

        // Validate zipcode
        if (!preg_match($regexNumbersOnly, $zipcode)) {

            $_SESSION['zipcode'] = "";
            echo '<div class="alert alert-warning" role="alert"> Please enter a valid zipcode! (Only numbers allowed)  </div>';

            // Validate email
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $_SESSION['email'] = "";
            echo '<div class="alert alert-warning" role="alert"> Invalid email format, please enter a valid email. </div>';

            // When everthing is filled in correct
        } else {

            //Order confirmation 

            echo '<div class="alert alert-success" role="alert"> <h3> Thank you for your order! </h3> <hr> <h4 class="alert-heading"> Order confirmtation </h4> You\'ve ordered: </br> <p>';

            foreach ($_POST['products'] as $i => $product) {
                echo $products[$i]['name'] . "</br>";
                $totalValue += ($products[$i]['price']);
            }

            echo "To: " . $_POST['street'] . " " . $_POST['streetnumber'] . ", " . $_POST['city'] . " " .  $_POST['zipcode'] . "</p> </div>";
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
