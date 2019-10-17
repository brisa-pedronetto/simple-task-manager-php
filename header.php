<?php
// Start session if it hasn't been initialized yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Redirect visitor to login page in case it is not logged in.
if (!in_array($_SERVER['PHP_SELF'], ['/login.php', '/register.php']) && !isset($_SESSION['user'])) {
    header('Location: /login.php?next=' . $_SERVER['REQUEST_URI']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/sketchy/bootstrap.min.css">
</head>

<body>
    <div class="container py-3">
        <nav class="navbar navbar-dark py-3 mb-3" style="background-color: #dcb235;">
            <a class="navbar-brand mr-auto" href="/">Task Manager</a>

            <?php if (isset($_SESSION['user'])) : ?>
                <form action="/">
                    <input type="text" name="search" value="<?php echo (isset($_GET['search'])) ? $_GET['search'] : '' ?>" placeholder="Search" class="form-control">
                </form>
                <a href="/add_task.php" class="btn btn-primary ml-3">Add new task</a>
                <a href="/logout.php" class="btn btn-outline-primary ml-3">Logout</a>
            <?php else : ?>
                <a href="/login.php" class="btn btn-primary ml-3">Login</a>
                <a href="/register.php" class="btn btn-primary ml-3">Register</a>
            <?php endif; ?>
        </nav>
