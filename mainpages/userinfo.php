<?php
    $id = '';
    $nameforreview = '';
    $reply = '';
      session_start();
      $name = $_SESSION['username'] ?? '';
    
      include('./connection.php');
      $sql = "SELECT * from customers where customerName = '$name'";
      $result = mysqli_query($conn, $sql);
      $info = mysqli_fetch_all($result, MYSQLI_ASSOC);
     $id = $info[0]['customerId'];
     $nameforreview = $info[0]['customerName'];
     
      if(isset($_POST['sendbtn'])){
        if(!empty($_POST['review'])){
            $review = $_POST['review'];
            $sql = "INSERT INTO review (customerId,name,review) VALUES ($id, '$nameforreview','$review' )";
            $result = mysqli_query($conn, $sql);
            $reply = "Thanks for your review.";
        }else{
            $reply =  'Write your review in the box.';
        }
       
      }
      mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/Sheetdesign.css">
    <title>Document</title>
</head>
<body>    
    <?php  include('./headers_footer/header.php')  ?>
    <div class="container5">
        <div class="contact">
            <p class="info-name">Name : <?php echo !$info[0]['customerName'] ? '' : $info[0]['customerName']?></p>
                
            <p>Email: <?php echo !$info[0]['email'] ? '' :  $info[0]['email']  ?></p>
            <p>Phone Number: <?php echo !$info[0]['phoneNumber'] ? '' : $info[0]['phoneNumber'] ?></p>
            <p>Address: <?php echo !$info[0]['address'] ? '' : $info[0]['address']  ?></p>
        </div>
        <div class="send">
            <h4>Please share your experience with us.Your reviews help our website to become better.</h4>
            <p class="reply"><?= !$reply ? '' : $reply?></p>
            <form action="userinfo.php" method="post">
                <textarea  name="review" placeholder="Write here"></textarea>
               
                <input class="sendbtn" type="submit" name="sendbtn" value="Send">
            </form>
        </div>
    </div>
        
    <?php include('./headers_footer/footer.php')?>
</body>
</html>