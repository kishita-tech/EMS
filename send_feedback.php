<?php

session_start();
include "db.php";

$username = $_POST['username'];
$message  = $_POST['message'];

$query = "INSERT INTO feedback(username, message)
VALUES('$username', '$message')";

if(mysqli_query($conn, $query)){

    echo "
    <script>
        alert('Response Sent Successfully');
        window.location.href='view_events.php';
    </script>
    ";

} else {

    echo "Error!";
}

?>