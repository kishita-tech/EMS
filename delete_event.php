<?php
session_start();
include("db.php");

// login check
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // get image name (optional - delete file also)
    $get = mysqli_query($conn, "SELECT image FROM events WHERE id='$id'");
    $data = mysqli_fetch_assoc($get);

    if($data){
        $image_path = "uploads/" . $data['image'];

        // delete image file from folder
        if(file_exists($image_path)){
            unlink($image_path);
        }
    }

    // delete from database
    $query = "DELETE FROM events WHERE id='$id'";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Event Deleted Successfully'); window.location='view_events.php';</script>";
    } else {
        echo "<script>alert('Error deleting event');</script>";
    }
}
?>