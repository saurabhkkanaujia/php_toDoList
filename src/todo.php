<?php
    session_start();
    include 'functions.php';
    $action = '';
    $flag = 0;
    
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
            case 'delete1':
                $del_id = $_POST['hid_val1'];
                array_splice($_SESSION['completed'], $del_id, 1);
                break;
            case 'edit':
                $flag = 1;
                $edit_field = $_POST['hid_val'];
                $_SESSION['id'] = $edit_field;
                break;
        
            case 'edit1':
                $edit_field1 = $_POST['hid_val1'];
                $_SESSION['id1'] = $edit_field1;
                break;
            case 'update':
                $updatedList = $_POST['list'];
                $_SESSION['lists'][$_SESSION['id']] = $updatedList;
                $flag = 0;
                break;
            case 'checkBox':
                $valChecked = 'checked';
                $check_id = $_POST['hid_val'];
                $listChecked = $_SESSION['lists'][$check_id];

                $completed = isset($_SESSION['completed'])?$_SESSION['completed']:array();
                array_push($completed, $listChecked);
                $_SESSION['completed'] = $completed;

                array_splice($_SESSION['lists'], $check_id, 1);
                break;
            case 'unchecked':
                $uncheck_id = $_POST['hid_val1'];
                $listUnChecked = $_SESSION['completed'][$uncheck_id];
                
                $lists = isset($_SESSION['lists'])?$_SESSION['lists']:array();
                array_push($lists, $listUnChecked);
                $_SESSION['lists'] = $lists;

                array_splice($_SESSION['completed'], $uncheck_id, 1);
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
                <?php if ($flag == 1): ?>
                    <input type = 'submit' name="action" value="update">
                <?php else: ?>
                    <input type = 'submit' name="action" value="add">
                <?php endif; ?>
            </p>
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
            <?php displayList(); ?>

            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
            <?php displayCompletedList($valChecked); ?>
            </ul>
            </form>

        </div>
    
    </body>
</html>