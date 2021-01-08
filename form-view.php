<?php // This files is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Your fancy store</title>
</head>
<body>
<?php // Navigation for when you need it ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="">
    <img src="./bottle.png" alt="" width="30" height="24">
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
            <legend>Address</legend>

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
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode;?>">
                </div>
            </div>
        </fieldset>

        <fieldset class="mt-3">
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?p= is equal to <?php echo ?>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button name="submit" type="submit" class="btn btn-primary mt-3">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in Bottled Up.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
    .alert {
        text-align: center;
        padding: 50px;
        margin: 0;
    }
</style>
</body>
</html>