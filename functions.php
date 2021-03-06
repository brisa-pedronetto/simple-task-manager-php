<?php
session_start();

function connect()
{
    global $connection;

    $credentials = [
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'task_manager',
        'port' => 3306
    ];

    // Create connection
    $connection = new mysqli(
        $credentials['servername'],
        $credentials['username'],
        $credentials['password'],
        $credentials['database'],
        $credentials['port']
    );

    // Check connection
    if ($connection->connect_error) {
        die('Connection failed: ' . $connection->connect_error);
    }

    return $connection;
}

function create_task($task)
{
    if (!$task || !is_array($task)) {
        die('Task not provided or is not array');
    }

    $connection = connect();

    // Task example
    // $task = [
    //     'title' => 'Finish PHP assignment',
    //     'description' => 'Study on W3Schools and ask on Slack when needed',
    //     'priority' => 10,
    //     'due_date' => '2019-10-20 23:59:59'
    // ];

    $sql  = "INSERT INTO tasks(title, description, priority, due_date, user_id) ";
    $sql .= "VALUES(";
    $sql .= "'" . $task['title'] . "',";
    $sql .= "'" . $task['description'] . "',";
    $sql .= $task['priority'] . ",";
    $sql .= "'" . $task['due_date'] . "', ";
    $sql .= $_SESSION['user']['ID'];
    $sql .= ")";

    // Test SQL
    // echo $sql;
    // exit;

    if ($connection->query($sql) === TRUE) {
        return 'New task created successfully';
    } else {
        die('Error: ' . $connection->error . '<br><br> SQL Query: ' . $sql);
    }
}

function get_task($task_id)
{

    if (!$task_id) {
        die('No task ID provided');
    }

    $connection = connect();

    $sql  = "SELECT * FROM tasks WHERE ID = $task_id AND user_id = " . $_SESSION['user']['ID'];

    // Test SQL
    // echo $sql;
    // exit;

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $connection->close();

        return $row;
    } else {
        die('Task does not exist');
    }
}

function get_all_tasks($params)
{
    $connection = connect();

    $sql  = "SELECT * FROM tasks WHERE user_id = " . $_SESSION['user']['ID'] . " ";
    if (isset($params['search'])) {
        $sql .= "AND (title LIKE '%" . $params['search'] . "%' OR description LIKE '%" . $params['search'] . "%') ";
    }
    if (isset($params['order'])) {
        switch ($params['order']) {
            case 'priority_desc';
                $sql .= "ORDER BY priority DESC";
                break;
            case 'priority_asc';
                $sql .= "ORDER BY priority ASC";
                break;
            case 'due_date_desc';
                $sql .= "ORDER BY due_date DESC";
                break;
            case 'due_date_asc';
                $sql .= "ORDER BY due_date ASC";
        }
    } else {
        $sql .= "ORDER BY priority DESC";
    }

    // Test SQL
    // echo $sql;
    // exit;

    $result = $connection->query($sql);

    $all_tasks = [];

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($all_tasks, $row);
        }
    }

    $connection->close();

    return $all_tasks;
}

function update_task($task)
{
    if (!$task || !is_array($task)) {
        die('No task provided');
    }

    $connection = connect();

    $sql  = "UPDATE tasks SET ";
    $sql .= "title = '" . $task['title'] . "', ";
    $sql .= "description = '" . $task['description'] . "', ";
    $sql .= "priority = " . $task['priority'] . ", ";
    $sql .= "due_date = '" . $task['due_date'] . "', ";
    $sql .= "status = '" . $task['status'] . "' ";
    $sql .= "WHERE ID = " . $task['ID'] . " ";
    $sql .= "AND user_id = " . $_SESSION['user']['ID'];

    // Test SQL
    // echo $sql;
    // exit;

    if ($connection->query($sql) === TRUE) {
        // The task was updated successfully
        $connection->close();

        return true;
    } else {
        die('Error: ' . $connection->error . '<br><br> SQL Query: ' . $sql);
    }
}

function delete_task($task_id)
{
    if (!$task_id) {
        die('No task ID provided');
    }

    $connection = connect();

    $sql  = "DELETE FROM tasks WHERE ID = $task_id AND user_id = " . $_SESSION['user']['ID'];

    // Test SQL
    // echo $sql;
    // exit;

    if ($connection->query($sql) === TRUE) {
        //The task was deleted successfully
        $connection->close();

        return true;
    } else {
        die('Error: ' . $connection->error . '<br><br> SQL Query: ' . $sql);
    }
}

function get_task_priority_color($priority)
{
    switch ((int) $priority) {
        case $priority > 7:
            return 'danger';
        case $priority > 4:
            return 'warning';
        default:
            return 'primary';
    }
}

function do_login($credentials)
{
    if (!$credentials || !is_array($credentials)) {
        die('No credentials provided or data is malformed');
    }

    $connection = connect();

    $sql  = "SELECT * FROM users WHERE ";
    $sql .= "username = '" . $credentials['username'] . "' ";
    $sql .= "AND password = '" . $credentials['password'] . "'";

    // Test SQL
    // echo $sql;
    // exit;

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $connection->close();

        return $row;
    } else {
        return false;
    }
}

function do_register($credentials)
{
    if (!$credentials || !is_array($credentials)) {
        die('No credentials provided or data is malformed');
    }

    $connection = connect();

    if (!!get_user($credentials['username'])) {
        return false;
    }

    $sql  = "INSERT INTO users (username, password) VALUES (";
    $sql .= "'" . $credentials['username'] . "', ";
    $sql .= "'" . $credentials['password'] . "')";

    // Test SQL
    // echo $sql;
    // exit;

    $result = $connection->query($sql);

    if ($result === TRUE) {
        $new_id = $connection->insert_id;
        $connection->close();
        return $new_id;
    } else {
        die('Error: ' . $connection->error . '<br><br> SQL Query: ' . $sql);
    }
}

function do_logout()
{
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }

    return true;
}

function get_user($user_id)
{
    if (!$user_id) {
        die('No user ID pr username provided');
    }

    $connection = connect();

    $sql  = "SELECT * FROM users WHERE ";

    if (is_integer($user_id)) {
        $sql .= "ID = " . $user_id;
    } else {
        $sql .= "username = '" . $user_id . "'";
    }

    // Test SQL
    // echo $sql;
    // exit;

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $connection->close();

        return $row;
    } else {
        return false;
    }
}
