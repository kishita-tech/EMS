<?php
session_start();
include("db.php");

// Login Check
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// Create Event
if(isset($_POST['create'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $seats = $_POST['seats'];
    $category = $_POST['category'];
    $organizer = $_POST['organizer'];
    $email = $_POST['email'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    if($image != ""){
        $image_name = time() . "_" . $image;
        move_uploaded_file($tmp, "uploads/" . $image_name);
    } else {
        $image_name = "";
    }

    // Validation
    if($title=="" || $description=="" || $date=="" || $time=="" || $location=="" || $seats==""){

        echo "<script>alert('All required fields must be filled');</script>";

    } else {

        $query = "INSERT INTO events
        (title, description, date, time, location, seats, category, organizer, email, image, created_by)

        VALUES

        ('$title','$description','$date','$time','$location','$seats','$category','$organizer','$email','$image_name','".$_SESSION['username']."')";

        if(mysqli_query($conn, $query)){

            echo "<script>
                    alert('Event Created Successfully');
                    window.location='view_events.php';
                  </script>";

        } else {

            echo "<script>alert('Error creating event');</script>";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Event</title>

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
    min-height:100vh;
    color:white;
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

.back-btn{
    background:#2563eb;
    padding:10px 20px;
    border-radius:12px;
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.back-btn:hover{
    background:#1d4ed8;
    color:white;
}

/* Form Card */

.form-container{
    padding:50px 15px;
}

.event-card{
    background:#111827;
    border-radius:28px;
    padding:45px;
    border:1px solid rgba(255,255,255,0.05);
    box-shadow:0 15px 40px rgba(0,0,0,0.3);
}

.event-card h2{
    font-weight:700;
    margin-bottom:10px;
}

.event-card p{
    color:#94a3b8;
    margin-bottom:35px;
}

/* Form Inputs */

.form-control,
.form-select{
    background:#1e293b;
    border:1px solid rgba(255,255,255,0.05);
    height:55px;
    border-radius:16px;
    color:white;
    padding-left:18px;
    margin-bottom:20px;
}

textarea.form-control{
    height:120px;
    padding-top:15px;
}

.form-control:focus,
.form-select:focus{
    background:#1e293b;
    border-color:#2563eb;
    box-shadow:none;
    color:white;
}

.form-control::placeholder{
    color:#94a3b8;
}

.form-select{
    color:#94a3b8;
}

/* Labels */

.form-label{
    margin-bottom:10px;
    font-weight:500;
    color:#e2e8f0;
}

/* Upload Box */

.upload-box{
    border:2px dashed rgba(255,255,255,0.1);
    border-radius:18px;
    padding:30px;
    text-align:center;
    background:#1e293b;
    margin-bottom:25px;
}

.upload-box i{
    font-size:45px;
    color:#3b82f6;
    margin-bottom:10px;
}

.upload-box p{
    margin:0;
    color:#94a3b8;
}

/* Submit Button */

.submit-btn{
    width:100%;
    height:58px;
    border:none;
    border-radius:16px;
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:white;
    font-size:17px;
    font-weight:600;
    transition:0.3s;
}

.submit-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 25px rgba(37,99,235,0.3);
}

/* Responsive */

@media(max-width:768px){

    .event-card{
        padding:30px 20px;
    }

}

</style>

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand" href="#">
            <i class="bi bi-calendar-plus-fill"></i>
            Add Event
        </a>

        <a href="dashboard.php" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

    </div>

</nav>

<!-- Form -->
<div class="container form-container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="event-card">

                <h2>Create New Event</h2>

                <p>
                    Fill in the event details below to create and manage your event professionally.
                </p>

                <form method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-6">

                            <label class="form-label">
                                Event Title
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   placeholder="Enter event title">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Location
                            </label>

                            <input type="text"
                                   name="location"
                                   class="form-control"
                                   placeholder="Enter location">

                        </div>

                    </div>

                    <label class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              class="form-control"
                              placeholder="Write event description"></textarea>

                    <div class="row">

                        <div class="col-md-6">

                            <label class="form-label">
                                Event Date
                            </label>

                            <input type="date"
                                   name="date"
                                   class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Event Time
                            </label>

                            <input type="time"
                                   name="time"
                                   class="form-control">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <label class="form-label">
                                Total Seats
                            </label>

                            <input type="number"
                                   name="seats"
                                   class="form-control"
                                   placeholder="Number of seats">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Category
                            </label>

                            <select name="category" class="form-select">

                                <option value="">Select Category</option>
                                <option>Seminar</option>
                                <option>Workshop</option>
                                <option>Party</option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <label class="form-label">
                                Organizer Name
                            </label>

                            <input type="text"
                                   name="organizer"
                                   class="form-control"
                                   placeholder="Organizer name">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Contact Email
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="example@email.com">

                        </div>

                    </div>

                    <!-- Upload -->
                    <label class="form-label">
                        Upload Event Image
                    </label>

                    <div class="upload-box">

                        <i class="bi bi-cloud-arrow-up-fill"></i>

                        <p>
                            Choose event image
                        </p>

                        <input type="file"
                               name="image"
                               class="form-control mt-3">

                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            name="create"
                            class="submit-btn">

                        <i class="bi bi-plus-circle-fill"></i>
                        Create Event

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>