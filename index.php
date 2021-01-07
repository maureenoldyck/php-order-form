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

/*
$products = [
    ['name' => 'Boyfriend Pillow - XL', 'price' => 25],
    ['name' => 'Boyfriend Pillow - M', 'price' => 20],
    ['name' => 'Boyfriend Pillow - S', 'price' => 15],
    ['name' => 'Girlfriend Pillow - XL', 'price' => 25],
    ['name' => 'Girlfriend Pillow - M', 'price' => 20],
    ['name' => 'Girlfriend Pillow - S', 'price' => 15],
    ['name' => 'Genderqueer Pillow - XL', 'price' => 25],
    ['name' => 'Genderqueer Pillow - M', 'price' => 20],
    ['name' => 'Genderqueer Pillow - S', 'price' => 15],
    ['name' => 'Big Banana Pillow - XL', 'price' => 25],
];
*/


// foreach ($_POST['products'] as $i => $product) {
//     $totalValue += ($products[$i]['price']);
// }

if (isset($_POST['submit'])) {

    // Validation required fields
    if (!empty($_POST['street']) && !empty($_POST['streetnumber']) && !empty($_POST['city']) && !empty($_POST['zipcode']) && !empty($_POST['email'])) {
       
        //Order confirmation 
        echo "Thank you for your order!";
    
        echo " <h3> Order confirmtation </h3> You've ordered: </br>";

        foreach ($_POST['products'] as $i => $product) {
            echo $products[$i]['name'] . "</br>";
        }

        echo "To: " . $_POST['street'] . " " . $_POST['streetnumber'] . " " . $_POST['city'] . " " .  $_POST['zipcode'];
    } else if ($_POST['products'] == NULL) {

        echo "Please select the products you want to buy!";
    }  else {

        echo "Please fill in all required fields!";
    } 
}



// $zipcode = $_POST['zipcode'];
// $regexNumbersOnly = "^[0-9]*$";

// preg_match($zipcode, $regexNumbersOnly);





require 'form-view.php';