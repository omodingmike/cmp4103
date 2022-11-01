<?php
    session_start();
    // check if user is logged in otherwise redirect to index page
    if (!isset($_SESSION['logged_in'])) {
        header("Location: index.php");
    }
?>
<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>CMP4103</title>
    <link rel="stylesheet" href="app/css/bootstrap.min.css">
    <link rel="stylesheet" href="app/css/custom.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6 mt-5 mx-auto">
            <h1 class="display-6 mb-5">You are logged in</h1>
            <a href="logout.php" class="text-decoration-none">Logout</a>
        </div>
    </div>

</div>

<script src="app/js/bootstrap.bundle.min.js"></script>
</body>
</html>
