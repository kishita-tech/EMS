<?php
session_start();
include("db.php");

// LOGIN CHECK
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// TODAY DATE
$today = date("Y-m-d");

// BASE QUERY
$query = "SELECT * FROM events WHERE 1";

// SEARCH
if(isset($_GET['search']) && !empty($_GET['search'])){

    $search = $_GET['search'];

    $query .= " AND (
        title LIKE '%$search%'
        OR location LIKE '%$search%'
    )";
}

// FILTER
if(isset($_GET['filter'])){

    if($_GET['filter'] == "upcoming"){

        $query .= " AND date >= '$today'";

    }

    elseif($_GET['filter'] == "past"){

        $query .= " AND date < '$today'";
    }
}

// ORDER
$query .= " ORDER BY id DESC";

// RUN QUERY
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

    <title>View Events</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <span class="navbar-brand">
            All Events
        </span>

        <a href="dashboard.php"
           class="btn btn-secondary">

           Back

        </a>

    </div>

</nav>

<div class="container mt-5">

    <!-- SEARCH -->
    <form method="GET" class="mb-3 d-flex">

        <input type="text"
               name="search"
               class="form-control me-2"
               placeholder="Search event...">

        <button class="btn btn-primary">
            Search
        </button>

    </form>

    <!-- FILTER -->
    <div class="mb-3">

        <a href="?filter=upcoming"
           class="btn btn-success btn-sm">

           Upcoming

        </a>

        <a href="?filter=past"
           class="btn btn-secondary btn-sm">

           Past

        </a>

        <a href="view_events.php"
           class="btn btn-dark btn-sm">

           All

        </a>

    </div>

    <!-- EVENT TABLE -->
    <div class="card shadow">

        <div class="card-header text-center">

            <h4>Event List</h4>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover text-center">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php
                if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_assoc($result)){
                ?>

                    <tr>

                        <!-- ID -->
                        <td>
                            <?php echo $row['id']; ?>
                        </td>

                        <!-- IMAGE -->
                        <td>

                            <img src="uploads/<?php echo $row['image']; ?>"
                                 width="80"
                                 height="60"
                                 class="rounded">

                        </td>

                        <!-- TITLE -->
                        <td>
                            <?php echo $row['title']; ?>
                        </td>

                        <!-- DATE -->
                        <td>
                            <?php echo $row['date']; ?>
                        </td>

                        <!-- TIME -->
                        <td>
                            <?php echo $row['time']; ?>
                        </td>

                        <!-- LOCATION -->
                        <td>
                            <?php echo $row['location']; ?>
                        </td>

                        <!-- ACTION -->
                        <td>

                            <!-- DELETE -->
                            <a href="delete_event.php?id=<?php echo $row['id']; ?>"
                               class="btn btn-danger btn-sm mb-1"
                               onclick="return confirm('Are you sure?')">

                               Delete

                            </a>

                            <!-- EDIT -->
                            <a href="edit_event.php?id=<?php echo $row['id']; ?>"
                               class="btn btn-warning btn-sm mb-1">

                               Edit

                            </a>

                            <!-- VIEW -->
                            <a href="event_details.php?id=<?php echo $row['id']; ?>"
                               class="btn btn-info btn-sm mb-1">

                               View

                            </a>

                            <!-- JOIN EVENT -->
                            <form action="join_event.php"
                                  method="POST"
                                  style="display:inline;">

                                <input type="hidden"
                                       name="event_id"
                                       value="<?php echo $row['id']; ?>">

                                <button type="submit"
                                        class="btn btn-success btn-sm mb-1">

                                    Join

                                </button>

                            </form>

                        </td>

                    </tr>

                <?php
                    }

                } else {
                ?>

                    <tr>

                        <td colspan="7">

                            <div class="alert alert-warning mb-0">

                                No Events Found

                            </div>

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