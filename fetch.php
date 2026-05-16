<?php

include("db.php");

$query = "
SELECT * FROM notifications
ORDER BY id DESC
";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

        echo "

        <div class='alert alert-warning mb-2'>

        🔔 ".$row['message']."

        </div>

        ";

    }

}
else{

    echo "
    <div class='alert alert-info'>
    No notifications
    </div>
    ";

}

?>