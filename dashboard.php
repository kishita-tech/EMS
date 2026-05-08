<?php
session_start();

// Login Check
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body{
            background:#0f172a;
            color:white;
            min-height:100vh;
        }

        /* Navbar */

        .navbar{
            background:#111827 !important;
            padding:18px 0;
            border-bottom:1px solid rgba(255,255,255,0.05);
        }

        .navbar-brand{
            font-size:24px;
            font-weight:700;
            color:white !important;
        }

        .logout-btn{
            background:#ef4444;
            border:none;
            padding:10px 20px;
            border-radius:12px;
            color:white;
            font-weight:600;
            text-decoration:none;
            transition:0.3s;
        }

        .logout-btn:hover{
            background:#dc2626;
            color:white;
            transform:translateY(-2px);
        }

        /* Main Area */

        .dashboard{
            padding:60px 0;
        }

        /* Left Welcome Card */

        .welcome-card{
            background:#111827;
            border-radius:24px;
            padding:50px;
            height:100%;
            border:1px solid rgba(255,255,255,0.05);
            box-shadow:0 10px 30px rgba(0,0,0,0.25);
        }

        .welcome-card h1{
            font-size:42px;
            font-weight:700;
            margin-bottom:20px;
        }

        .welcome-card p{
            color:#94a3b8;
            line-height:1.8;
            font-size:16px;
        }

        .welcome-icon{
            width:90px;
            height:90px;
            background:linear-gradient(135deg,#2563eb,#3b82f6);
            border-radius:20px;
            display:flex;
            justify-content:center;
            align-items:center;
            margin-bottom:30px;
            font-size:40px;
        }

        /* Action Panel */

        .action-panel{
            background:#111827;
            border-radius:24px;
            padding:40px;
            border:1px solid rgba(255,255,255,0.05);
            box-shadow:0 10px 30px rgba(0,0,0,0.25);
        }

        .action-panel h3{
            font-weight:700;
            margin-bottom:30px;
        }

        .action-btn{
            width:100%;
            padding:18px;
            border-radius:16px;
            text-decoration:none;
            display:flex;
            align-items:center;
            gap:15px;
            font-size:17px;
            font-weight:600;
            margin-bottom:20px;
            transition:0.3s;
            color:white;
        }

        .action-btn i{
            font-size:24px;
        }

        .add-btn{
            background:linear-gradient(135deg,#2563eb,#3b82f6);
        }

        .view-btn{
            background:linear-gradient(135deg,#059669,#10b981);
        }

        .action-btn:hover{
            transform:translateY(-4px);
            color:white;
            box-shadow:0 15px 25px rgba(0,0,0,0.25);
        }

        /* Responsive */

        @media(max-width:992px){

            .welcome-card{
                margin-bottom:25px;
            }

        }

    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand" href="#">
            <i class="bi bi-calendar-event-fill"></i>
            Event Management
        </a>

        <a href="logout.php" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>

    </div>

</nav>

<!-- Dashboard -->
<div class="container dashboard">

    <div class="row g-4 align-items-stretch">

        <!-- Left Side -->
        <div class="col-lg-8">

            <div class="welcome-card">

                <div class="welcome-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <h1>
                    Welcome,
                    <?php echo $_SESSION['username']; ?> 👋
                </h1>

                <p>
                    This dashboard helps you manage your events with a clean
                    and professional interface. You can create new events,
                    organize schedules, and view all event details from one place.
                </p>

            </div>

        </div>

        <!-- Right Side -->
        <div class="col-lg-4">

            <div class="action-panel">

                <h3>
                    Quick Actions
                </h3>

                <a href="add_event.php" class="action-btn add-btn">

                    <i class="bi bi-plus-circle-fill"></i>

                    Add Event

                </a>

                <a href="view_events.php" class="action-btn view-btn">

                    <i class="bi bi-card-list"></i>

                    View Events

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>