<?php
include('functions.php');

// Data got posted
if (!empty($_POST)) {

    // Do form validation here

    // Create a new task with the posted data
    create_task($_POST);

    header('Location: /?added');
}

include('header.php');
?>

<div class="row">
    <div class="col col-md-8 mx-md-auto">
        <h2 class="mb-4">Add a new task</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Task title">
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" placeholder="Task Description"></textarea>
            </div>

            <div class="form-group">
                <label>Priority</label>
                <select name="priority" class="form-control">
                    <?php foreach (range(1, 10) as $number) : ?>
                        <option><?php echo $number; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="">Due Date</label>
                <?php $date_in_5_days = date('Y-m-d\TH:i', mktime(0, 0, 0, date('m'), date('d') + 5, date('Y'))); ?>
                <input type="datetime-local" name="due_date" class="form-control" value="<?php echo $date_in_5_days; ?>">
            </div>

            <button class="btn btn-primary" type="submit">Add Task</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
