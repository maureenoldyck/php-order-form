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


// Global variables 
$totalValue = 0;


// Use this function when you need to need an overview of these variables
function whatIsHappening() {
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

// TODO: Fix errors
// foreach ($_POST['products'] as $i => $product) {
//     $totalValue += ($products[$i]['price']);
// }


// TODO: If the form was not valid, show the previous values in the form so that the user doesn't have to retype everything.
// TODO: Refactor in seperate functions

if (isset($_POST['submit'])) {

    // Validation required fields
    if (!empty($_POST['street']) && !empty($_POST['streetnumber']) && !empty($_POST['city']) && !empty($_POST['zipcode']) && !empty($_POST['email']) && isset($_POST['products'])) {
       

        $zipcode = $_POST['zipcode'];
        $regexNumbersOnly = "/^[0-9]*$/";
        $email = $_POST["email"];
  

        if (!preg_match($regexNumbersOnly, $zipcode)) {

           echo '<div class="alert alert-warning" role="alert"> Please enter a valid zipcode! (Only numbers allowed)  </div>';

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            echo '<div class="alert alert-warning" role="alert"> Invalid email format, please enter a valid email. </div>';

        } else { 

            //Order confirmation 

            echo '<div class="alert alert-secondary" role="alert"> Thank you for your order! </div>';
    
            echo " <h3> Order confirmtation </h3> You've ordered: </br>";

            foreach ($_POST['products'] as $i => $product) {
                echo $products[$i]['name'] . "</br>";
            }

            echo "To: " . $_POST['street'] . " " . $_POST['streetnumber'] . " " . $_POST['city'] . " " .  $_POST['zipcode'];
    
        } 

    }  else if ( !isset($_POST['products'])) {

        echo '<div class="alert alert-warning" role="alert"> Please select the products you want to buy! </div>';

    }   else {

        echo '<div class="alert alert-warning" role="alert"> Please fill in all required fields!  </div>';
    } 
}




require 'form-view.php';