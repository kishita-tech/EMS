<?php
session_start();
include("db.php");

// login check
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$today = date("Y-m-d");

$query = "SELECT * FROM events WHERE 1";

// search
if(isset($_GET['search']) && !empty($_GET['search'])){
    $search = $_GET['search'];
    $query .= " AND (title LIKE '%$search%' OR location LIKE '%$search%')";
}

// filter
if(isset($_GET['filter'])){
    if($_GET['filter'] == "upcoming"){
        $query .= " AND date >= '$today'";
    } 
    elseif($_GET['filter'] == "past"){
        $query .= " AND date < '$today'";
    }
}

$query .= " ORDER BY id DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Events</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>

body{
    background:#0f172a;
    color:white;
    font-family:Inter, sans-serif;
}

/* Navbar */
.navbar{
    background:#111827 !important;
    border-bottom:1px solid rgba(255,255,255,0.05);
}

/* Container */
.container{
    margin-top:40px;
}

/* Search box */
.search-box{
    background:#111827;
    padding:15px;
    border-radius:16px;
    border:1px solid rgba(255,255,255,0.05);
}

.search-box input{
    background:#1e293b;
    border:none;
    color:white;
    height:45px;
    border-radius:12px;
}

.search-box input:focus{
    background:#1e293b;
    color:white;
    box-shadow:none;
}

/* Filters */
.btn-filter{
    border-radius:12px;
    padding:8px 15px;
    font-weight:600;
}

/* Card */
.card{
    background:#111827 !important;
    border:1px solid rgba(255,255,255,0.05);
    border-radius:20px;
    overflow:hidden;
}

/* Table FIX */
.table-dark{
    background:#111827;
}

.table-dark thead{
    background:#1f2937 !important;
}

.table-dark tbody tr:hover{
    background:#1e293b;
}

/* Image */
img{
    border-radius:10px;
    object-fit:cover;
}

/* Buttons */
.btn-sm{
    border-radius:10px;
    font-weight:600;
}

</style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand">
            <i class="bi bi-calendar-event-fill"></i> All Events
        </span>

        <a href="dashboard.php" class="btn btn-outline-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</nav>

<div class="container">

    <!-- Search -->
    <form method="GET" class="search-box d-flex gap-2 mb-3">

        <input type="text" name="search" class="form-control" placeholder="Search event...">

        <button class="btn btn-primary px-4">
            <i class="bi bi-search"></i>
        </button>

    </form>

    <!-- Filters -->
    <div class="mb-4">

        <a href="?filter=upcoming" class="btn btn-success btn-filter">Upcoming</a>
        <a href="?filter=past" class="btn btn-secondary btn-filter">Past</a>
        <a href="view_events.php" class="btn btn-dark btn-filter">All</a>

    </div>

    <!-- Table -->
    <div class="card shadow">

        <div class="card-body table-responsive">

            <table class="table table-dark table-hover text-center align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td><?php echo $row['id']; ?></td>

                        <!-- IMAGE FIXED -->
                        <td>
                            <?php if(!empty($row['image']) && file_exists("uploads/".$row['image'])) { ?>
                                <img src="uploads/<?php echo $row['image']; ?>" width="70" height="50">
                            <?php } else { ?>
                                <img src="https://via.placeholder.com/70x50?text=No+Image" width="70" height="50">
                            <?php } ?>
                        </td>

                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td><?php echo $row['location']; ?></td>

                        <td>

                            <a href="event_details.php?id=<?php echo $row['id']; ?>"
                               class="btn btn-info btn-sm">
                                View
                            </a>

                            <a href="edit_event.php?id=<?php echo $row['id']; ?>"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="delete_event.php?id=<?php echo $row['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure?')">
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>