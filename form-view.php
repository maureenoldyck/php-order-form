<?php // This files is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Your fancy store</title>
</head>
<body>
<?php // Navigation for when you need it ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="">
    <img src="./bottle.png" alt="" width="40" height="34">
     Bottled Up
</a>
    <ul class="nav p-3">
        <li class="nav-item">
            <a class="nav-link active" href="?air=0">Order Air in a Bottle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?air=1">Order Water in a Bottle</a>
        </li>
    </ul>
</nav>
<div class="container mt-3">
    <h1>Place your order</h1>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $email;?>"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend> <h1> Address </h1> </legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo $street;?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php echo $streetnumber;?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php echo $city;?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode:</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode;?>">
                </div>
            </div>
        </fieldset>

        <fieldset class="mt-3">
            <legend> <h1> Products </h1> </legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?p= is equal to <?php echo ?>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> 
                    <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) . ' - '?> 
                    <select name='quantity[]'>
                    <option value='1'>1</option>  
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    </select>                
                </label> <br/>
            <?php endforeach; ?>
        </fieldset>
        <legend class="mt-3"> <h1> Express shipping - €5 for delivery in 45min </h1> </legend>
        <input type="radio" id="normal" name="expressShipping" value="0" checked>
        <label for="normal">No</label>
        <input type="radio" id="express" name="expressShipping" value="5">
        <label for="express">Yes</label>
        <br>
        <button name="submit" type="submit" class="btn btn-primary mt-3">Order!</button>
    </form>
    
    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> and <strong> <?php echo $orders ?></strong> products in Bottled Up. </footer>
</div>

<style>
    body {
        background-color: #C3D6F2;
    }
    footer {
        text-align: center;
        margin-bottom: 20px;
    }
    .alert {
        text-align: center;
        padding: 50px;
        margin: 0 auto;
    }
    h1 {
        font-family: 'Amatic SC', cursive;
    }
    .navbar-brand {
        font-family: 'Amatic SC', cursive;
        font-size: 45px;
    }
    .order-confirmation {
        margin: 0 auto;
        text-align: left;
        width: 50%;
    }
</style>
</body>
</html>