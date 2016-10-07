<?php
    session_start();
    if (isset($_SESSION)) {
        session_destroy();
        header("location:index.php");
    } 
    else {
        echo "<p>Aucune session ouverte</p>";
    }
?>
    