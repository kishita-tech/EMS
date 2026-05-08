<?php
session_start();
include("db.php");

// login check (optional - remove if public access chahida)
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// get event id
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM events WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "No event selected";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Event Details</span>
        <a href="view_events.php" class="btn btn-secondary">Back</a>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow">
        <div class="row g-0">

            <!-- Image -->
            <div class="col-md-5">
                <img src="uploads/<?php echo $row['image']; ?>" class="img-fluid h-100" style="object-fit:cover;">
            </div>

            <!-- Details -->
            <div class="col-md-7">
                <div class="card-body">

                    <h3 class="card-title"><?php echo $row['title']; ?></h3>

                    <p class="card-text mt-3">
                        <?php echo $row['description']; ?>
                    </p>

                    <hr>

                    <p><strong>📅 Date:</strong> <?php echo $row['date']; ?></p>
                    <p><strong>⏰ Time:</strong> <?php echo $row['time']; ?></p>
                    <p><strong>📍 Location:</strong> <?php echo $row['location']; ?></p>

                    <p><strong>👤 Created By:</strong> <?php echo $row['created_by']; ?></p>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>