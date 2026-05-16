<?php

session_start();
include "db.php";

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];

    $check = mysqli_query($conn,
    "SELECT * FROM participants
    WHERE user_id='$user_id'
    AND event_id='$event_id'");

    if(mysqli_num_rows($check) > 0){

        echo "
        <script>
            alert('You already joined this event!');
            window.location.href='view_events.php';
        </script>
        ";

    } else {

        $query = "INSERT INTO participants
        (user_id, event_id)
        VALUES
        ('$user_id', '$event_id')";

        if(mysqli_query($conn, $query)){

            echo "
            <script>
                alert('Event Joined Successfully!');
                window.location.href='view_events.php';
            </script>
            ";

        } else {

            echo "Error!";
        }
    }

} else {

    header("Location: login.php");
}
?>