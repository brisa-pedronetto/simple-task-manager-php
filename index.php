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

<?php if (empty($all_tasks)) : ?>
    <div class="alert alert-warning" role="alert">
        There are currently no tasks. <a href="/add_task.php">Click here</a> to add one.
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-4">
            <h2 class="mb-4">To Do</h2>

            <?php if (empty($to_do_tasks)) : ?>
                <div class="alert alert-warning" role="alert">
                    There are no tasks in this list.
                </div>
            <?php endif; ?>

            <?php foreach ($to_do_tasks as $task) : ?>
                <?php include('partials/task_card.php'); ?>
            <?php endforeach; ?>
        </div>

        <div class="col-4">
            <h2 class="mb-4">Doing</h2>

            <?php if (empty($doing_tasks)) : ?>
                <div class="alert alert-warning" role="alert">
                    There are no tasks in this list.
                </div>
            <?php endif; ?>

            <?php foreach ($doing_tasks as $task) : ?>
                <?php include('partials/task_card.php'); ?>
            <?php endforeach; ?>
        </div>

        <div class="col-4">
            <h2 class="mb-4">Done</h2>

            <?php if (empty($done_tasks)) : ?>
                <div class="alert alert-warning" role="alert">
                    There are no tasks in this list.
                </div>
            <?php endif; ?>

            <?php foreach ($done_tasks as $task) : ?>
                <?php include('partials/task_card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php include('footer.php'); ?>
