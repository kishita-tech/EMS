<?php
session_start();
include("db.php");

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "user"; // default role

    // simple validation
    if(!empty($username) && !empty($email) && !empty($password)){

        // password hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // insert query
        $query = "INSERT INTO users (username, email, password, role) 
                  VALUES ('$username', '$email', '$hashed_password', '$role')";

        if(mysqli_query($conn, $query)){
            echo "<script>alert('Registration Successful'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error');</script>";
        }

    } else {
        echo "<script>alert('Please fill all fields');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Register</h4>
                </div>

                <div class="card-body">
                    <form method="POST">

                        <input type="text" name="username" class="form-control mb-3" placeholder="Username">

                        <input type="email" name="email" class="form-control mb-3" placeholder="Email">

                        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

                        <button type="submit" name="register" class="btn btn-primary w-100">
                            Register
                        </button>

                    </form>

                    <p class="mt-3 text-center">
                        Already have an account? <a href="login.php">Login</a>
                    </p>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>