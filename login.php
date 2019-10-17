<?php
session_start();

include('functions.php');

// Initialize error message variable
$error_msg = '';

// Do login if credentials got posted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = do_login($_POST);
    if ($user) {
        // Set user in session
        $_SESSION['user'] = $user;

        // Redirect the user
        header('Location: ' . ((isset($_GET['next'])) ? $_GET['next'] : '/'));
    } else {
        $error_msg = 'Login credentials didn\'t match an account';
    }
}

?>

<?php include('header.php') ?>

<div class="h-100 d-flex justify-content-center align-items-center">
    <div class="border border-dark p-4 rounded" style="min-width:30rem; max-width: 100%;">
        <h1>Login</h1>

        <?php if (!empty($error_msg)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>

<?php include('footer.php') ?>
