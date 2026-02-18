<?php
include "db.php";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    $password = md5($password);

    $sql = "SELECT * FROM users 
            WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        echo "
        <script>
            alert('Login Successful');
            window.location.href='index.html';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Invalid Email or Password');
            window.location.href='login.html';
        </script>
        ";
    }
}
?>