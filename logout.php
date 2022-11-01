<?php
    session_start();
    // Logging out a user
    unset($_SESSION['logged_in']);
    header("Location: index.php");


