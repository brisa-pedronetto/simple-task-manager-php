<?php
include('functions.php');

// If no id was passed, exit
if (!isset($_POST['id'])) {
    header('Location: /?error=no_id');
}

// Get task that has to be updated
$task = get_task($_POST['id']);

$task['status'] = $_POST['status'];

update_task($task);

header('Location: /?updated');
