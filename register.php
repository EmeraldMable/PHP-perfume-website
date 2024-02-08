<?php

   
    $errors = array("name" => "" , "number" => "" , "email" => "" , "address" => "" , "password" => "" , "confirm" => "");
    $name = $email =$userid =  $number = $address = $password = $confirm= $alreadyExit = $registerid = '';
    $users = array();

    include('connection.php');
    if(isset($_POST['registerbtn'])){
      

       

        if(!empty($_POST['username'])){
            $name = $_POST['username'];
            if(!preg_match('/^[a-zA-z\s]+$/' , $name)){
                 $errors['name'] = 'Invalid username';
            }
        }else{
            $errors['name'] = 'Write your username.';
        }

        if(!empty($_POST['number'])){
            $number = $_POST['number'];
           
        }else{
            $errors['number'] = 'Phone number is required';
        }

        if(!empty($_POST['email'])){
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
                $errors['email'] = 'Invalid email address';
            }
        }else{
            $errors['email'] = 'Email is required';
        }

        if(!empty($_POST['address'])){
            $address = $_POST['address'];
        }else{
            $errors['address'] = "Your address is required.";
        }

        
        if(!empty($_POST['password'])){
            $password = $_POST['password'];
        }else{
            $errors['password'] = "Password is required.";
        }

        if(!empty($_POST['confirm'])){
            $confirm = $_POST['confirm'];
            if($confirm != $password){
                $errors['confirm'] = "Password must be the same.";
            }
        }else{
            $errors['confirm'] = "Required.";
        }
      


        if(!array_filter($errors)){
           
           
            $data = "SELECT * from customers where email = '$email'";
            $return = mysqli_query($conn,$data);
            $users = mysqli_fetch_all($return, MYSQLI_ASSOC);
           
            if(!array_filter($users)){
                session_start();
                $_SESSION['username'] = $name;
                $_SESSION['userid'] = $registerid;
                $sql = "INSERT into customers (customerName,email,phoneNumber,address,password) values ('$name','$email','$number','$address','$password')";
                $result = mysqli_query($conn,$sql);
                header('location: index.php');

                $query = "SELECT * from customers where customerName = $name";
                $send = mysqli_query($conn, $query);
                $data = mysqli_fetch_all($send,MYSQLI_ASSOC);
                $registerid = $data[0]['customerId'];

            }else{
                $alreadyExit = 'The email is already registered.';
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
    <title>Login page</title>
</head>
<body>
    <form class="loginform" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label id="ue-label" for="username">Username: </label>
        <input id="name" type="text" name="username" placeholder="<?php echo $name ? '' : 'Enter your username'  ?>">
        <p><?php echo htmlspecialchars ($errors['name'])?></p>

        <label for="number">Phone number: </label>
        <input id="number" type="text" name="number" placeholder="<?php echo $number ? '' : '0983737383' ?>">
        <p><?php echo htmlspecialchars ($errors['number'])?></p>

        <label  for="email">Email: </label>
        <input id="email" type="email" name="email" placeholder="<?php echo $email ? '' : 'Enter your email' ?>">
        <p><?php echo htmlspecialchars ($errors['email'])?></p>
        <p><?php echo htmlspecialchars (!$alreadyExit ? '' : $alreadyExit)?></p>

        <label id="ue-label" for="address">Address: </label>
        <input id="address" type="text" name="address" placeholder="<?php echo $address ? '' : 'Enter your address' ?>">
        <p><?php echo htmlspecialchars ($errors['address'])?></p>

        <label id="ue-label" for="password">Password: </label>
        <input id="password" type="text" name="password" placeholder="<?php echo $password ? '' : 'Create a password' ?>">
        <p><?php echo htmlspecialchars ($errors['password'])?></p>

        <label id="ue-label" for="confirm">Confirm your password: </label>
        <input id="confirm" type="text" name="confirm" placeholder="<?php echo $confirm ? '' : 'Re-type your password' ?>">
        <p><?php echo htmlspecialchars ($errors['confirm'])?></p>

       

        <input class="loginbtn" type="submit" name="registerbtn" value="Register">
    </form>
</body>
</html>