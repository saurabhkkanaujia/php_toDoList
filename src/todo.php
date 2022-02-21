<?php
    session_start();
    include 'functions.php';
    $action = '';
    if (isset($_POST['action'])){
        $list = $_POST['list'];
        $action = $_POST['action'];
        $list_id = $_POST['hid_val'];
        switch ($action){
            case 'add':
                addList($list);
                break;
            case 'delete':
                $del_id = $_POST['hid_val'];
                array_splice($_SESSION['lists'], $list_id, 1);
                break;
            case 'edit':
                $edit_field = $_POST['hid_val'];
                $_SESSION['id'] = $edit_field;
                break;
            case 'update':
                $updatedList = $_POST['list'];
                $_SESSION['lists'][$_SESSION['id']] = $updatedList;
                break;
        }
    }

?>

<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <form action="" method="POST">
            <p>
                <input id="new-task" name="list" type="text" value="<?php echo $_SESSION['lists'][$edit_field]; ?>">
                <input type = 'submit' name="action" value="add">
                <input type = 'submit' name="action" value="update">
            </p>
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
            <?php displayList(); ?>

            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
                <li><input type="checkbox" checked>
                <label>See the Doctor</label><input type="text"><button class="edit">Edit</button><button class="delete">Delete</button></li>
            </ul>
            </form>

        </div>
    
    </body>
</html>