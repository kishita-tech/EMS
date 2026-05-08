<?php
session_start();
include("db.php");

// login check
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// get event data
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM events WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
}

// update event
if(isset($_POST['update_event'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];

    // image update (optional)
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $folder = "uploads/" . $image;

        move_uploaded_file($tmp_name, $folder);

        $query = "UPDATE events SET 
                  title='$title',
                  description='$description',
                  date='$date',
                  time='$time',
                  location='$location',
                  image='$image'
                  WHERE id='$id'";
    } else {
        $query = "UPDATE events SET 
                  title='$title',
                  description='$description',
                  date='$date',
                  time='$time',
                  location='$location'
                  WHERE id='$id'";
    }

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Event Updated Successfully'); window.location='view_events.php';</script>";
    } else {
        echo "<script>alert('Error updating event');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Edit Event</h4>
                </div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">

                        <input type="text" name="title" class="form-control mb-3"
                               value="<?php echo $row['title']; ?>" required>

                        <textarea name="description" class="form-control mb-3" required><?php echo $row['description']; ?></textarea>

                        <input type="date" name="date" class="form-control mb-3"
                               value="<?php echo $row['date']; ?>" required>

                        <input type="time" name="time" class="form-control mb-3"
                               value="<?php echo $row['time']; ?>" required>

                        <input type="text" name="location" class="form-control mb-3"
                               value="<?php echo $row['location']; ?>" required>

                        <input type="file" name="image" class="form-control mb-3">

                        <button type="submit" name="update_event" class="btn btn-primary w-100">
                            Update Event
                        </button>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>