<?php

$customerid ='';
$productId = '';
$return = '';
$already = '';
include('./connection.php');
session_start();
$name = $_SESSION['username'] ?? '';
$sql = "SELECT customerId from customers where customerName = '$name'";
$result = mysqli_query($conn, $sql);
$id = mysqli_fetch_all($result, MYSQLI_ASSOC);
$customerid = $id[0]['customerId']??'';
$_SESSION['customerId']=$customerid;
$_SESSION['exit'] = $already;

    /*productid*/
    if(isset($_GET['id'])){
        $productId = mysqli_real_escape_string($conn, $_GET['id']);
 
        $detailsql = "SELECT * from products where productId = $productId";

       $result = mysqli_query($conn,$detailsql);
       
       $perfume = mysqli_fetch_array($result);
       
      
    }


    if(isset($_POST['addbtn'])){

          
           
                $cartname = $_POST['cartname'];
                $productid = $_POST['productId'];
               
                $cartprice = $_POST['cartprice'];
                $cartqty = $_POST['cartqty'];

                $sql =mysqli_query($conn, "SELECT productId from cart where productId = $productid and customerId = $customerid");
                $return = mysqli_fetch_all($sql,MYSQLI_ASSOC);
           
                if($sql){
                    if(array_filter($return)){
                      
                       header('location: cart.php');
                    }else{
                        $sql = "INSERT INTO cart (customerId,productId,cartname, cartprice , cartqty) VALUES ('$customerid','$productid','$cartname', '$cartprice' , '$cartqty' )";
        
                        $result = mysqli_query($conn,$sql);
                        header('location: cart.php');
                       
                    }
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
    <title>Details</title>
</head>
<body>
    <?php  if(isset($_SESSION['username'])){
                if($adminemail){
                    include_once('./headers_footer/adminheader.php');
                }else{
                    include_once('./headers_footer/header.php');
                }
            }else{
                include_once('./headers_footer/headerLogin.php');
            }
    ?>

    <div class="container">
        <form action="details.php" method="post">
        <img class="photo" src="data:image/png;base64,<?php echo base64_encode($perfume['image'])?>">
        <p class="productname"><?php echo $perfume['productName']?></p>

        <div class="paragraph">
            <p><?php echo $perfume['description']?></p>
            <div class="scent">
                <div class="notes">
                    <p><strong>Top Notes </strong>: <?php echo $perfume['TopNotes']?></p>
                    <p><strong>Middle Notes </strong> : <?php echo $perfume['MiddleNotes']?></p>
                    <p><strong>Base Notes </strong> : <?php echo $perfume['BaseNotes']?></p>
            
                </div>
               
                <input type="hidden" name="cartname" value="<?php echo $perfume['productName']?>">
                <input type="hidden" name="productId" value="<?php echo $perfume['productId']?>">
                <input type="hidden" name="cartprice" value="<?php echo $perfume['price']?>">
                <input type="hidden" name="cartqty" value="1">
                
                <input class="addbtn" type="submit" name="addbtn" value="Add to Cart">
            
                <p class="price"><?php echo $perfume['price']?>000 Kyats</p>
            </div>
        </div>
        </form>

        <div class="policy">
            <div class="return">
           <h3 class="policy-title">Return Policy</h3>
           <p> You may return any unopened merchandise in its original condition, including original sealed packaging within 30 days of invoice date and you will receive a full refund, less shipping and gift-wrapping charges.
            All online orders must be shipped back to our warehouse. We do not accept online returns in stores.
            You should expect to receive your refund within 2-3 weeks of giving your package to the return shipper, however, in many cases you will receive a refund more quickly. You will be notified via email when your refund has been processed.
            </p>
            </div>
            <div class="shipping">
                <h3 class="policy-title">Shipping</h3>
                <p>
                    Orders over 500000 Kyats (after discounts have been applied and excluding taxes) ship FREE. Orders of 500000 Kyats or less (after discounts have been applied and excluding taxes) will incur a standard shipping charge of just $3000, $10000 for regional places.
                    Standard shipping typically takes about 3-5 business days to arrive.
                    To facilitate the timely processing of your order, we are unable to cancel or make any changes to orders once they are placed.
                </p>
            </div>
        </div>
        

    </div>
   
    <?php include('./headers_footer/footer.php')?>
</body>
</html>