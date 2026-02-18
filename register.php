<?php
include "db.php";

if (isset($_POST['register'])) {

    
    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $mobile   = trim($_POST['mobile']);
    $password = trim($_POST['password']);

    
    $password = md5($password);

    
    $check = "SELECT * FROM users WHERE email='$email'";
    $checkResult = mysqli_query($conn, $check);

    if (mysqli_num_rows($checkResult) > 0) {
        
        echo "
        <script>
            alert('Email already registered');
            window.location.href='registration.html';
        </script>
        ";
        exit();
    }

    
    $sql = "INSERT INTO users (fullname, email, mobile, password, created_at)
            VALUES ('$fullname', '$email', '$mobile', '$password', NOW())";

    if (mysqli_query($conn, $sql)) {
        
        echo "
        <script>
            alert('Registration Successful');
            window.location.href='login.html';
        </script>
        ";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>