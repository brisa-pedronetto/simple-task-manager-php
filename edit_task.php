<?php
include('functions.php');

// If no id was passed, exit
if (!isset($_GET['id'])) {
    header('Location: /?error=no_id');
}

// Control variable used for a feedback message
$updated = false;

// Get task that has to be updated
$task = get_task($_GET['id']);

// Update task if new data was sent via post
if (!empty($_POST)) {
    $task['title'] = $_POST['title'];
    $task['description'] = $_POST['description'];
    $task['priority'] = $_POST['priority'];
    $task['due_date'] = $_POST['due_date'];
    $task['status'] = $_POST['status'];

    update_task($task);

    $updated = true;
}

include('header.php');
?>

<div class="row">
    <div class="col col-md-8 mx-md-auto">
        <?php if ($updated) : ?>
            <div class="alert alert-success" role="alert">
                The task was updated. <a href="/">Go back to front page</a>.
            </div>
        <?php endif; ?>

        <h2 class="mb-4">Editing: <?php echo $task['title']; ?></h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Task title" value="<?php echo $task['title']; ?>">
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" placeholder="Task Description"><?php echo $task['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Priority</label>
                <select name="priority" class="form-control">
                    <?php foreach (range(1, 10) as $number) : ?>
                        <option <?php echo ((int) $task['priority'] === $number) ? 'selected' : ''; ?>><?php echo $number; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="">Due Date</label>
                <input type="datetime-local" name="due_date" class="form-control" value="<?php echo str_replace(' ', 'T', $task['due_date']); ?>">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="To Do" <?php echo ($task['status'] === 'To Do') ? 'selected' : ''; ?>>To Do</option>
                    <option value="Doing" <?php echo ($task['status'] === 'Doing') ? 'selected' : ''; ?>>Doing</option>
                    <option value="Done" <?php echo ($task['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Edit Task</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
