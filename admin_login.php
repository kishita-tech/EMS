<?php
session_start();
include("db.php");

// ADMIN LOGIN
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // CHECK ADMIN
    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        // SIMPLE PASSWORD CHECK
        if($password == $row['password']){

            // SESSION
            $_SESSION['admin'] = $row['username'];

            // REDIRECT
            echo "<script>
                    alert('Admin Login Successful');
                    window.location='admin_dashboard.php';
                  </script>";

        } else {

            echo "<script>
                    alert('Wrong Password');
                  </script>";
        }

    } else {

        echo "<script>
                alert('Admin Not Found');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f4f4f4;
    font-family:Arial;
}

.login-box{
    width:400px;
    background:white;
    padding:35px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

.form-control{
    margin-bottom:20px;
    height:50px;
}

.btn-login{
    width:100%;
    height:50px;
    background:black;
    color:white;
    border:none;
}

</style>

</head>

<body>

<div class="login-box">

    <h2 class="text-center mb-4">
        Admin Login
    </h2>

    <form method="POST">

        <!-- USERNAME -->
        <input type="text"
               name="username"
               class="form-control"
               placeholder="Enter Admin Username"
               required>

        <!-- PASSWORD -->
        <input type="password"
               name="password"
               class="form-control"
               placeholder="Enter Password"
               required>

        <!-- BUTTON -->
        <button type="submit"
                name="login"
                class="btn-login">
            Login
        </button>

    </form>

</div>

</body>
</html>