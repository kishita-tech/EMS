<?php
include "db.php";

$events = mysqli_query($conn,
"SELECT * FROM events ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Event System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row">

        <!-- Notifications -->

        <div class="col-md-4">

            <div class="card p-3 shadow">

                <h3>Notifications</h3>

                <div id="notification-area"></div>

            </div>

        </div>

       

            <?php while($row = mysqli_fetch_assoc($events)) { ?>

                <div class="card p-3 shadow mb-3">

                    <h3>
                        <?php echo $row['title']; ?>
                    </h3>

                    <p>
                        <?php echo $row['description']; ?>
                    </p>

                    <a
                        href="join-event.php?id=<?php echo $row['id']; ?>"
                        class="btn btn-primary"
                    >
                        Participate
                    </a>

                </div>

            <?php } ?>

        </div>

    </div>

</div>


<script>

// Auto Load Notifications

function loadNotifications(){

    fetch("notice.php")
    .then(response => response.text())
    .then(data => {

        document.getElementById("notification-area").innerHTML = data;

    });

}

// Load first time
loadNotifications();

// Reload every 3 seconds
setInterval(loadNotifications, 3000);

</script>

</body>
</html>