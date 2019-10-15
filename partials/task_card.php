<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title"><?php echo $task['title']; ?></h5>
        <div class="card-text"><?php echo $task['description']; ?></div>

        <hr>

        <label>Priority:</label> <?php echo $task['priority']; ?>

        <hr>

        <form action="update_task_status.php" method="post" class="update-task-status">
            <input type="hidden" name="id" value="<?php echo $task['ID']; ?>">
            <select name="status" class="form-control">
                <option value="To Do" <?php echo ($task['status'] === 'To Do') ? 'selected' : ''; ?>>To Do</option>
                <option value="Doing" <?php echo ($task['status'] === 'Doing') ? 'selected' : ''; ?>>Doing</option>
                <option value="Done" <?php echo ($task['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
            </select>
        </form>

        <br>

        <div class="d-flex">
            <a href="/edit_task.php?id=<?php echo $task['ID']; ?>" class="btn btn-outline-primary flex-fill mr-2">Edit</a>
            <a href="/remove_task.php?id=<?php echo $task['ID']; ?>" class="btn btn-outline-danger flex-fill">Remove</a>
        </div>
    </div>
</div>
