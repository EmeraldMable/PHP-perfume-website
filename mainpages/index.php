<?php  
    $name = '';
    $brandId= '';
    $brand='All Items';
    $des = 'We collect most recommended perfumes and colognes aiming to save your time searching for star-rated perfumes.
    This collection is to prevent customers from losing money for not-your-type perfumes. Note: We get 2% from your purchase on this website.
    ';
    $products = array();
   
    session_start();
    $name = $_SESSION['username'] ?? '';
    $adminemail = $_SESSION['adminemail']?? '';


    include('./connection.php');

    

    $sql = "SELECT * FROM products INNER JOIN brands ON products.brandId = brands.brandId ";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        $products = mysqli_fetch_all($result , MYSQLI_ASSOC);
    }else{
        echo 'no item is found.';
    }



    if(isset($_POST['searchbtn'])){
        $text = $_POST['search'];
        if($text){
            $sql = "SELECT * FROM products INNER JOIN brands ON products.brandId = brands.brandId where brandName ='$text' || productName = '$text'";
            $result = mysqli_query($conn,$sql);
            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $brand = strtoupper($text);
          
            if(!array_filter($products)){
                $brand = 'Sorry!';
                $des = 'The one you\'re searching is not found.But you can take a look at our most star-rated perfume collection.';
            }
        }else {
            $brand = 'Oops!';
            $des = 'Enter the name of the perfume or brand you\'re looking for.';
            $products = array();
        }
       }

   if(isset($_POST['brand'])){
    $brand = $_POST['brand'];
    if($brand == 'All'){
        $sql = "SELECT * FROM products INNER JOIN brands ON products.brandId = brands.brandId";
        $result = mysqli_query($conn,$sql);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $brand = "All Items";
    }else if($brand == "Best Sellers"){
        $sql="SELECT * from products INNER JOIN brands ON products.brandId = brands.brandId where rating = 5";
        $result = mysqli_query($conn, $sql);
        $products = mysqli_fetch_all($result , MYSQLI_ASSOC);
        $brand = "Best Sellers";
    }else{
        $sql = "SELECT * FROM products INNER JOIN brands ON products.brandId = brands.brandId where brands.brandName = '$brand'";
        $result = mysqli_query($conn,$sql);
        $products = mysqli_fetch_all($result , MYSQLI_ASSOC);
        $des = $products[1]['description'];
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
    
    <title>Index Page</title>
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
    <h2 class="username">Hello Dear <?php echo $name ? $name : 'Guest' ?></h2>
   
    <div class="container2">
   
       <?php include('./components/category.php') ?>
            <div class="brand-des">
                <h2 class="brand-name"><?= $brand  ?></h2>
                <p class="brand-info"><?= $des ?></p>
            </div>

        <div class="allitems">
         
    
        <?php foreach($products as $product){?>
           
           <div class="allitem">
          
               <div class="allname">
               <?php echo !$product['productName'] ? '' : $product['productName'].'<br>' ?>
               </div>
               <div class="rating">
               <p><span><?php echo $product['rating'] ?></span>/5 stars</p>
               
               <p><?php echo $product['price']. '000 Kyats'. '<br>' ?></p>
               </div>
               <img src="data:image/jpg;base64,<?php echo base64_encode($product['image'])?>" alt="Perfume bottle">
               <div class="forgender">
                    <?php if(isset($_SESSION['username'])){ ?>
                    <a class="more" href="details.php?id=<?php echo $product['productId']?>">More info</a>
                    <?php }else{?>
                        <a class="more" href="login.php">More info</a>
                    <?php }?>
                    <p class="gen">For <strong><?php echo $product['gender'] ?></strong></p>
               </div>
           </div>
           <?php  } ?>
         </div>
         
    </div>
    <?php include('./components/review.php'); ?>
    <?php include('./headers_footer/footer.php')?>
 
</body>
</html>



