<?php
include('functions.php');

// Do login if credentials got posted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $new_user_id = do_register($_POST);

    if ($new_user_id) {
        // Redirect the user
        header('Location: /login.php?registered');
    } else {
        $error_msg = 'It was not possible to register the user.';
    }
}

?>

<?php include('header.php') ?>

<div class="h-100 d-flex justify-content-center align-items-center">
    <div class="border border-dark p-4 rounded" style="min-width:30rem; max-width: 100%;">
        <h1>Register</h1>

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

            <div class="text-right">
                <button type="submit" class="btn btn-primary ml-auto" style="width: 10rem;">Register</button>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php') ?>
