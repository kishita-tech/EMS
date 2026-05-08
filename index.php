<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background: #f8f9fc;
        }

        .navbar{
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        }

        .hero{
            height: 90vh;
            background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
                        url('https://images.unsplash.com/photo-1523580846011-d3a5bc25702b');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero h1{
            font-size: 55px;
            font-weight: 700;
        }

        .hero p{
            font-size: 18px;
            opacity: 0.9;
        }

        .btn-custom{
            padding: 12px 30px;
            border-radius: 30px;
        }

        .section-title{
            font-weight: 600;
        }

        .feature-card{
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .feature-card i{
            font-size: 40px;
            color: #0d6efd;
        }

        .feature-card:hover{
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        footer{
            margin-top: 60px;
            font-size: 14px;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <a class="navbar-brand fw-bold" href="#">Event System</a>

    <div>
        <a href="index.php" class="btn btn-outline-light btn-sm me-2">Home</a>

        <?php if(isset($_SESSION['username'])) { ?>
            <a href="dashboard.php" class="btn btn-success btn-sm me-2">Dashboard</a>
            <a href="view_events.php" class="btn btn-primary btn-sm me-2">Events</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        <?php } else { ?>
            <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
            <a href="register.php" class="btn btn-warning btn-sm">Register</a>
        <?php } ?>
    </div>

  </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <h1>Manage Your Events Smartly</h1>
        <p class="mt-3">Create, organize, and track your events effortlessly</p>

        <?php if(!isset($_SESSION['username'])) { ?>
            <a href="register.php" class="btn btn-warning btn-lg btn-custom mt-4">Get Started</a>
        <?php } else { ?>
            <a href="dashboard.php" class="btn btn-success btn-lg btn-custom mt-4">Go to Dashboard</a>
        <?php } ?>
    </div>
</section>

<!-- FEATURES -->
<section class="container mt-5">
    <h2 class="text-center section-title mb-5">Features</h2>

    <div class="row g-4 text-center">

        <div class="col-md-4">
            <div class="card p-4 feature-card shadow-sm">
                <i class="bi bi-calendar-event mb-3"></i>
                <h5>Create Events</h5>
                <p class="text-muted">Quickly create and customize events with ease.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 feature-card shadow-sm">
                <i class="bi bi-pencil-square mb-3"></i>
                <h5>Manage Events</h5>
                <p class="text-muted">Edit, update, or delete events anytime.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 feature-card shadow-sm">
                <i class="bi bi-bar-chart-line mb-3"></i>
                <h5>Track Activity</h5>
                <p class="text-muted">Monitor all your events in one dashboard.</p>
            </div>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        © <?php echo date("Y"); ?> Event Management System <br>
        <small>Developed by Kishita & Supreet</small>
    </div>
</footer>

</body>
</html>