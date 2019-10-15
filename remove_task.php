<?php
include('functions.php');

// If no id was passed, exit
if (!isset($_GET['id'])) {
    header('Location: /?error=no_id');
}

// Get task that has to be updated
delete_task($_GET['id']);

header('Location: /?removed');
