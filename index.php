<?php
    session_start();

    use CMP4103\Database\Database;

    if (isset($_SESSION['logged_in'])) {
        header('Location: dashboard.php');
    }
    require_once 'vendor/autoload.php';
    $database = new Database;
    $message  = [];
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $database->medoo()->select('users', "*",
            [
                'username' => $username,
            ]
        );
        if ($user) {
            if (password_verify($password, $user[0]['password'])) {
                $_SESSION['logged_in'] = true;
                $message['success']    = 'Login successful';
            } else {
                $message['error'] = 'Provided credentials do not match';
            }
        } else {
            $message['error'] = 'Provided credentials do not match';
        }
    }

?>


<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>CMP4103</title>
    <link rel='stylesheet' href='app/css/bootstrap.min.css'>
    <link rel='stylesheet' href='app/css/custom.css'>
    <link rel='stylesheet' href='app/css/sweetalert2.min.css'>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6 mt-5 mx-auto">
            <h1 class="display-6 mb-5">CMP4103 Login</h1>
            <form method="post" action="index.php" autocomplete='off'>
                <div class='mb-3'>
                    <label for='username' class='form-label'>Username</label>
                    <input type='text' class='form-control' id='username' name="username" aria-describedby='emailHelp'>
                    <div id='error-username' class='form-text'></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <a href="register.php" class="text-decoration-none">I do not have an account</a>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

        </div>
    </div>

</div>

<script src='app/js/jquery-3.6.0.min.js'></script>
<script src='app/js/bootstrap.bundle.min.js'></script>
<script src='app/js/sweetalert2.all.min.js'></script>

<?php
    if (isset($message['error'])) {
        ?>
        <script>
            jQuery(function ($) {
                Swal.fire({
                    title: 'Error!',
                    text: '<?php echo $message['error'] ?>',
                    icon: 'error',
                })
            });
        </script>
        <?php
    }
?>
</body>
</html>
