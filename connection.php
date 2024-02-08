<?php
    $db_server = 'localhost';
    $db_name = 'perfume_db';
    $db_password = '';
    $db_user = 'root';
    $conn = '';
    $conn = mysqli_connect($db_server , $db_user, $db_password , $db_name);
    if(!$conn)  {
    echo "error". mysqli_connect_error();
}
?>