<?php

    use CMP4103\Database\Database;
    use CMP4103\Helpers;

    require_once 'vendor/autoload.php';
    $database = new Database;

    $messages = [];
    if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['confirm_password'])) {
        $user_name          = $_POST['username'];
        $password           = $_POST['password'];
        $confirm_password   = $_POST['confirm_password'];
        $errors             = [];
        $errors['username'] = Helpers::validateUserName($user_name);
        $errors['password'] = Helpers::validatePassword($password, $confirm_password);
        $errors_exist       = true;
        foreach ($errors as $key => $value) {
            if (empty($value)) {
                $errors_exist = false;
            }
        }

        if (!$errors_exist) {
            $user = $database->medoo()->insert('users',
                [
                    'username' => $user_name,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]
            );
            if ($user->rowCount() > 0) {
                $messages['success'] = 'Registration successfully';
            } else {
                $messages['error'] = 'Registration failed';
            }
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
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class='container'>
    <div class='row'>
        <div class='col-6 mt-5 mx-auto'>
            <h1 class='display-6 mb-5'>CMP4103 Register</h1>
            <form method='post' action='register.php' autocomplete='off'>
                <div class='mb-3'>
                    <label for='username' class='form-label'>Username</label>
                    <input type='text' class='form-control' id='username' aria-describedby='emailHelp' value="<?php
                        echo $user_name ?? '' ?>" autocomplete="name" name="username">
                    <div class='form-text error'><?php
                            echo $errors['username']['empty'] ?? $errors['username']['less'] ?? $errors['username']['greater'] ??
                                $errors['username']['numeric'] ?? ''
                        ?></div>
                </div>

                <div class='mb-3'>
                    <label for='password' class='form-label'>Password</label>
                    <input type='password' class='form-control' id='password' name="password" autocomplete='password' value="<?php
                        echo $password ?? '' ?>">
                    <div class='form-text error'><?php
                            echo $errors['password']['empty'] ?? $errors['password']['less'] ?? $errors['password']['greater'] ??
                                $errors['password']['numeric'] ?? $errors['password']['uppercase'] ?? ''
                        ?></div>
                </div>

                <div class='mb-3'>
                    <label for='confirm_password' class='form-label'>Confirm Password</label>
                    <input type='password' class='form-control' id='confirm_password' name="confirm_password">
                    <div class='form-text error'><?php
                            echo $errors['password']['match'] ?? '' ?></div>
                </div>
                <div>
                    <a href='index.php' class="mb-5 text-decoration-none">I have an account</a>
                </div>
                <button type='submit' class='btn btn-primary mt-2'>Register</button>
            </form>

        </div>
    </div>

</div>
<script src='app/js/jquery-3.6.0.min.js'></script>
<script src='app/js/bootstrap.bundle.min.js'></script>
<script src='app/js/sweetalert2.all.min.js'></script>
<?php
    if (isset($messages['error'])) {
        ?>
        <script>
            jQuery(function ($) {
                Swal.fire({
                    title: 'Error!',
                    text: '<?php echo $messages['error'] ?>',
                    icon: 'error',
                })
            });
        </script>
        <?php
    }
?>
<?php
    if (isset($messages['success'])) {
        ?>
        <script>
            jQuery(function ($) {
                Swal.fire({
                    title: 'Success',
                    text: '<?php echo $messages['success'] ?>',
                    icon: 'success',
                }).then(function () {
                    window.location.href = 'index.php'
                })
            });
        </script>
        <?php
    }
?>


</body>
</html>
