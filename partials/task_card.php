<div class="card mb-4 p-2 rounded">
    <div class="card-body">
        <h5 class="card-title"><?php echo $task['title']; ?></h5>
        <div class="card-text"><?php echo $task['description']; ?></div>

        <hr>

        <div class="row">
            <div class="col">
                <span class="badge badge-<?php echo get_task_priority_color($task['priority']); ?>">Priority: <?php echo $task['priority']; ?></span>
            </div>

            <div class="col">
                <span class="badge badge-secondary">Due Date: <?php echo date('d/m/Y @ h:ia', strtotime($task['due_date'])); ?></span>
            </div>
        </div>

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
