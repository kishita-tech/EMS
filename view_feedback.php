<?php
include "db.php";

$data = mysqli_query($conn,
"SELECT * FROM feedback ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>User Responses</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            <h4>User Responses</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Response</th>
                    <th>Date</th>
                </tr>

                <?php while($row=mysqli_fetch_assoc($data)){ ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['username']; ?></td>

                    <td><?php echo $row['message']; ?></td>

                    <td><?php echo $row['created_at']; ?></td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>