<?php
include('functions.php');

$all_tasks = get_all_tasks();

$to_do_tasks = array_filter($all_tasks, function ($task) {
    return ($task['status'] === 'To Do') ? true : false;
});

$doing_tasks = array_filter($all_tasks, function ($task) {
    return ($task['status'] === 'Doing') ? true : false;
});

$done_tasks = array_filter($all_tasks, function ($task) {
    return ($task['status'] === 'Done') ? true : false;
});

include('header.php');
?>

<?php if (isset($_GET['added'])) : ?>
    <div class="alert alert-success" role="alert">
        A new task was added
    </div>
<?php endif; ?>

<?php if (isset($_GET['updated'])) : ?>
    <div class="alert alert-success" role="alert">
        The task was updated
    </div>
<?php endif; ?>

<?php if (isset($_GET['removed'])) : ?>
    <div class="alert alert-success" role="alert">
        The task was removed
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-4">
        <h2 class="mb-4">To Do</h2>

        <?php foreach ($to_do_tasks as $task) : ?>
            <?php include('partials/task_card.php'); ?>
        <?php endforeach; ?>
    </div>

    <div class="col-4">
        <h2 class="mb-4">Doing</h2>

        <?php foreach ($doing_tasks as $task) : ?>
            <?php include('partials/task_card.php'); ?>
        <?php endforeach; ?>
    </div>

    <div class="col-4">
        <h2 class="mb-4">Done</h2>

        <?php foreach ($done_tasks as $task) : ?>
            <?php include('partials/task_card.php'); ?>
        <?php endforeach; ?>
    </div>
</div>

<?php include('footer.php'); ?>
