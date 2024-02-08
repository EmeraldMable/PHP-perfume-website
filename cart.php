<?php
     $nodb = '';
     $productid = '';
     $choosePayment = '';
     $emptycart='';
     $carts = array();
     $totalAll = array();   
 

    session_start();
    $customerid = $_SESSION['userid']?? '';
    $already = $_SESSION['exit']?? '';
    
    include('connection.php');
  

    $sql = "SELECT * from cart where customerId = '$customerid' ";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        $carts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
    }else{
       $nodb ='No item is added yet.';
    }

    /*if(isset($_GET['id'])){
        if($productid = mysqli_real_escape_string($conn,$_GET['id'])){
           
            $sql = "ALTER TABLE `cart` ADD UNIQUE(`productId`)";
            $delete = mysqli_query($conn, $sql);
            $productid =  mysqli_real_escape_string($conn,$_GET['id']);
        }
    }*/




  if(isset($_POST['cancelbtn'])){
    $cartid = $_POST['cartid'];
    $delete = "DELETE from cart where cartid = '$cartid'";

   $del = mysqli_query($conn,$delete);
  }

  if(isset($_POST['buybtn'])){
    if(!empty($_POST['payment'])){
        if(!$carts){
            $emptycart = 'No item is in the cart';
        }else{
            $delete = "DELETE from cart";
            $del = mysqli_query($conn,$delete);
            header('location: orderShip.php'); 
        }
           
    }else{
        $choosePayment = 'Please choose one payment.';
     }
    
    
  }
   


    if(isset($_POST['increase'])){
        $qtyid = $_POST['qtyid'];
        $cartqty = $_POST['cartqty'];
        $sql = "UPDATE `cart` SET `cartqty` = $cartqty + 1 WHERE `cart`.`cartid` = $qtyid";
        $addition = mysqli_query($conn, $sql);
    }else if(isset($_POST['decrease'])){
             if($_POST['cartqty'] == 1){
            $qtyid = $_POST['qtyid'];
            $cartqty = $_POST['cartqty'];
            $sql = "UPDATE `cart` SET `cartqty` = 1 WHERE `cart`.`cartid` = $qtyid";
            $minimum = mysqli_query($conn, $sql);
        }else{
            $qtyid = $_POST['qtyid'];
            $cartqty = $_POST['cartqty'];
            $sql = "UPDATE `cart` SET `cartqty` = $cartqty - 1 WHERE `cart`.`cartid` = $qtyid";
            $substraction = mysqli_query($conn, $sql);
        }
        
    }

    
    
         
    

  
   mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/stylesheet.css">
    <title>Cart</title>
</head>
<body>
    <?php  include('header.php')  ?>

    
    <div class="container3">
        
       
        <p class="noitem"><?= $nodb?></p>
        <p><?= $already ?></p>
        <div class="cart">
            <?php foreach($carts as $cart){?>
      
            <div class="card">
        
                <p class="title"><?php echo $cart['cartname']?></p>
                 <form action="cart.php" method="post">
                 
                  <p class="qty"> <input type="submit" name="decrease" value="-"> <span>   <?php echo $cart['cartqty'] ?></span>
                  <input  type="hidden" name="qtyid" value="<?php echo $cart['cartid'] ?>">
                  <input type="hidden" name="cartqty" value="<?php echo $cart['cartqty']?>">
                   <input type="submit" name="increase" value="+"></p>
                  
            
              </form>
              
           
                <p class="price"><?php  echo $totalAll[] = $cart['cartprice']* $cart['cartqty'] ?>000 Kyats</p>
            
     
         
                <div class="btns">
                    <form action="cart.php" method="post">
                        <input type="hidden" name="cartid" value="<?php echo $cart['cartid']?>">
                        
                        <input class="cancelbtn" type="submit" name="cancelbtn" value="Remove">
                </div>

             </div>
            <?php  } ?> 
            
        </div>
        
    </div>
    <div class="total">
    <p class="noti"><?php echo !$choosePayment ? '' : $choosePayment?></p>
    <p class="noti"><?= !$carts ? $emptycart : ''?></p>
            <div class="totalPrice">
                
                <p>Total Price </p>
                <p><strong><?php echo !array_sum($totalAll) ? ' 0 Kyats' : array_sum($totalAll).'000 Kyats'?></strong></p>
            </div>
            <div class="totalitem">
                <p>Total Item</p>
                <p><?php echo sizeof($carts)?> items</p>
            </div>
            <form action="cart.php" method="post">
                <div class="payment">
                    <h4 class="choose">Choose Your Payment</h4>
                    <p class="radio"><input type="radio" name="payment" value="AYA" >AYA Bank</p>
                    <p class="radio"><input type="radio" name="payment" value="KBZ" >KBZ Pay</p>
                    <p class="radio"><input type="radio" name="payment" value="Cash">Cash on delivery</p>
                   
                </div>
                <input class="buybtn" type="submit" name="buybtn" value="Check Out">
            </form>
            
          </div>
          </form>

    <?php  include('footer.php')  ?>
</body>
</html>

