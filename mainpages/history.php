<?php
session_start();
$adminemail =$_SESSION['adminemail'] ?? '';
?>



<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/Sheetdesign.css">
    <title>History</title>
</head>
<body>
    <?php  if(isset($_SESSION['username'])){
                if($adminemail){
                    include_once('../headers_footer/adminheader.php');
                }else{
                    include_once('../headers_footer/header.php');
                }
            }else{
                include_once('../headers_footer/headerLogin.php');
            }
    ?>

    <div class="container4">
        <video class="video" controls autoplay muted loop src="../public/Riza Perfume - Cinematic Perfume Commercial - Eau De Perfume - Digicomm India.mp4"></video>
        <div>
        <p class="covername">ODOR</p>
       

       <p class="describe">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius culpa laudantium perspiciatis porro dignissimos quod voluptatem magni adipisci neque fuga quaerat nostrum, ipsa eos, autem amet quis? Temporibus consectetur neque quisquam possimus porro sapiente voluptate odio animi sequi accusamus autem mollitia at dignissimos nisi totam, adipisci molestiae voluptas. Possimus incidunt dolore, quibusdam, accusamus qui fugiat minus dolor ducimus facilis amet laboriosam soluta quo asperiores fugit, vitae reiciendis. Alias, hic at!</p>
        </div>
        
    </div>
    <?php  include('../headers_footer/footer.php')  ?>
</body>
</html>