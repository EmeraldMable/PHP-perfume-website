<?php
include('connection.php');
$sql = "SELECT * from review";
$result = mysqli_query($conn, $sql);
$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/stylesheet.css">
    <title>Review</title>
</head>
<body>
    <div class="review">
        <h2 class="review-section">Reviews from our beloved customers</h2>
        <?php  foreach($reviews as $review){?>
            <div class="review-card">
                <h2><?= $review['name']?></h2>
                <p>"<?= $review['review']  ?>"</p>
            </div>
       <?php }?>
        
    </div>
</body>
</html>