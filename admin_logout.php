<?php
session_start();

// DESTROY SESSION
session_destroy();

// MESSAGE + REDIRECT
echo "<script>
        alert('Logout Successfully');
        window.location='admin_login.php';
      </script>";
?>