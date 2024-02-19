<?php

   
    $errors = '';
    $name =  $password = $email=  '';
   
    include('connection.php');
    if(isset($_POST['loginbtn'])){
        if(!empty($_POST['name']) && !empty($_POST['password'])){
            
            $name = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
           
            $sql = "SELECT * from customers where email = '$email' and password = $password";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if(array_filter($data)){
                $username = $data[0]['customerName'];
                $userid = $data[0]['customerId'];
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $userid;
                header('location: index.php');
                
            }else{
                $errors = 'Please register first.';
            }


    }else{
        $errors = 'Please fill in all the fields.';
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
    <title>Login page</title>
</head>
<body>
    <form class="loginform" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
         <p><?php echo htmlspecialchars ($errors)?></p>
        <label id="ue-label" for="username">Username: </label>
        <input id="name" type="text" name="name" placeholder="<?php echo $name ? $name : 'Enter your username'  ?>">
      

        <label  for="email">Email: </label>
        <input id="email" type="email" name="email" placeholder="<?php echo $email ? '' : 'Enter your email' ?>">
       


        <label id="ue-label" for="password">Password: </label>
        <input id="password" type="text" name="password" placeholder="<?php echo $password ? $password : 'Enter your password' ?>">
     

       
       

        <input class="loginbtn" type="submit" name="loginbtn" value="Login">
    </form>
</body>
</html>