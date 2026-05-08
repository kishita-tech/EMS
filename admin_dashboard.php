<?php
session_start();
include("db.php");

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// FETCH DATA
$users = mysqli_query($conn, "SELECT * FROM users");
$events = mysqli_query($conn, "SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
<div class="container">

<span class="navbar-brand">
Admin Dashboard
</span>

<a href="admin_logout.php"
   class="btn btn-danger">
   Logout
</a>

</div>
</nav>

<div class="container mt-5">

<!-- USERS -->
<div class="card p-4 shadow mb-4">

<h3>Registered Users</h3>

<table class="table table-bordered mt-3">

<tr>
<th>ID</th>
<th>Username</th>
</tr>

<?php while($row = mysqli_fetch_assoc($users)) { ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['username']; ?></td>
</tr>

<?php } ?>

</table>

</div>

<!-- EVENTS -->
<div class="card p-4 shadow">

<h3>All Events</h3>

<table class="table table-bordered mt-3">

<tr>
<th>ID</th>
<th>Title</th>
<th>Date</th>
<th>Seats</th>
</tr>

<?php while($event = mysqli_fetch_assoc($events)) { ?>

<tr>
<td><?php echo $event['id']; ?></td>
<td><?php echo $event['title']; ?></td>
<td><?php echo $event['date']; ?></td>
<td><?php echo $event['seats']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>