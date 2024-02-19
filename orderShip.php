<?php
    session_start();
    $address = $_SESSION['address'] ?? '';
    $username = $_SESSION['username'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/stylesheet.css">
    <title>OrderShipped</title>
</head>
<body>
    <?php include('header.php')?>
    <div class="ship">
        <h2 class="shipaddress">Your Order is shipped to <?php echo $address?></h2>
        <h3>Thanks for shopping with us , <?php echo $username ?></h3>
        <button class="homebtn">
            <a href="index.php">Back to homepage</a>
        </button>
    </div>
    <?php include('footer.php')?>
</body>
</html>