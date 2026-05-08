<?php
session_start();
include("db.php");

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(!empty($username) && !empty($password)){

        $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){

            $user = mysqli_fetch_assoc($result);

            if(password_verify($password, $user['password'])){

                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                echo "<script>
                        alert('Login Successful');
                        window.location='dashboard.php';
                      </script>";

            } else {
                echo "<script>alert('Wrong Password');</script>";
            }

        } else {
            echo "<script>alert('User Not Found');</script>";
        }

    } else {
        echo "<script>alert('Please fill all fields');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            overflow:hidden;
        }

        /* Animated background circles */

        .circle{
            position:absolute;
            border-radius:50%;
            background:rgba(255,255,255,0.1);
            animation: float 6s infinite ease-in-out;
        }

        .circle:nth-child(1){
            width:200px;
            height:200px;
            top:10%;
            left:5%;
        }

        .circle:nth-child(2){
            width:300px;
            height:300px;
            bottom:5%;
            right:10%;
            animation-duration:8s;
        }

        @keyframes float{
            0%,100%{
                transform:translateY(0px);
            }
            50%{
                transform:translateY(-20px);
            }
        }

        .login-card{
            width:100%;
            max-width:420px;
            background:rgba(255,255,255,0.15);
            border-radius:20px;
            padding:40px;
            backdrop-filter: blur(15px);
            box-shadow:0 8px 32px rgba(0,0,0,0.2);
            border:1px solid rgba(255,255,255,0.2);
            color:white;
            position:relative;
            z-index:10;
        }

        .login-card h2{
            font-weight:700;
            text-align:center;
            margin-bottom:10px;
        }

        .login-card p{
            text-align:center;
            color:#e0e0e0;
            margin-bottom:30px;
        }

        .form-control{
            height:50px;
            border-radius:12px;
            border:none;
            padding-left:45px;
            background:rgba(255,255,255,0.2);
            color:white;
        }

        .form-control::placeholder{
            color:#f1f1f1;
        }

        .form-control:focus{
            box-shadow:none;
            background:rgba(255,255,255,0.25);
            color:white;
        }

        .input-group{
            position:relative;
            margin-bottom:20px;
        }

        .input-group i{
            position:absolute;
            top:50%;
            left:15px;
            transform:translateY(-50%);
            color:white;
            z-index:2;
        }

        .btn-login{
            width:100%;
            height:50px;
            border:none;
            border-radius:12px;
            background:linear-gradient(135deg, #ff512f, #dd2476);
            color:white;
            font-size:16px;
            font-weight:600;
            transition:0.3s;
        }

        .btn-login:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 20px rgba(0,0,0,0.2);
        }

        .extra-links{
            margin-top:20px;
            text-align:center;
            color:#f1f1f1;
        }

        .extra-links a{
            color:#fff;
            text-decoration:none;
            font-weight:600;
        }

        .extra-links a:hover{
            text-decoration:underline;
        }

        .logo{
            width:80px;
            height:80px;
            background:white;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:0 auto 20px;
            color:#2575fc;
            font-size:35px;
            font-weight:bold;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
        }

    </style>
</head>

<body>

    <!-- Background Design -->
    <div class="circle"></div>
    <div class="circle"></div>

    <div class="login-card">

        <div class="logo">
            <i class="bi bi-person-fill"></i>
        </div>

        <h2>Welcome Back</h2>
        <p>Login to continue your journey</p>

        <form method="POST">

            <div class="input-group">
                <i class="bi bi-person"></i>
                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Enter Username">
            </div>

            <div class="input-group">
                <i class="bi bi-lock"></i>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter Password">
            </div>

            <button type="submit" name="login" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>

        </form>

        <div class="extra-links">
            Don't have an account?
            <a href="register.php">Register</a>
        </div>

    </div>

</body>
</html>