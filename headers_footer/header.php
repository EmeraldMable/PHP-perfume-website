<?php

$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'] , '/')+1);


$id = '';
$name = '';
   $name = $_SESSION['username'] ?? '';
    include('../connection.php');
    if(!empty($_SESSION)){
        $query = "SELECT customerId from customers where customerName = '$name'";
        $send = mysqli_query($conn,$query);
        $return = mysqli_fetch_assoc($send);
        
        $id = $return['customerId'] ?? '';
        
        $sql = "SELECT * from cart where customerId = '$id' ";
        $result = mysqli_query($conn,$sql);
    
    }else{
        $id = null;
    }
   
   
   
    mysqli_close($conn);   
     

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/Sheetdesign.css">
   
    <title>Header</title>
</head>
<body>

    <nav>
        
        <div class="brand"><a href="../mainpages/index.php">ODOR</a></div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav_items">
            <li class="nav_item <?php echo $page == 'index.php' ? 'active' : ''?> "><a href="../mainpages/index.php">Products</a></li>            
            <li class="nav_item <?php echo $page == 'history.php' ? 'active' : ''?> "><a href="../mainpages/history.php">Our History</a></li>
            <li class="nav_item"><a href="../mainpages/userinfo.php"><img class="user  <?php echo $page == 'userinfo.php' ? 'active' : ''?> " src="../public/user.svg" alt="usericon"></a></li>
            <li class="nav_item "><a href="../mainpages/cart.php"><img class="icon <?php echo $page == 'cart.php' ? 'active' : ''?>" src="../public/cart.svg" alt="cart"></a><span><?php echo mysqli_num_rows($result) ? mysqli_num_rows($result)  : '0' ?></span></li>
            <li class="nav_item"><a href='../admission/logout.php'>Log Out</a></li>
        </ul>
    </nav>
</body>
</html>