<?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'] , '/')+1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/Sheetdesign.css">
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
           
            <li class="nav_item <?php echo $page == 'index.php' ? 'active' : ''  ?>"><a href="../mainpages/index.php">Products</a></li>
          
            <li class="nav_item  <?php echo $page == 'history.php' ? 'active' : ''  ?>"><a href="../mainpages/history.php">Our History</a></li>
            <li class="nav_item  <?php echo $page == 'login.php' ? 'active' : ''  ?>"><a href="../admission/register.php">Register/Log in</a></li>
        </ul>
    </nav>
</body>
</html>