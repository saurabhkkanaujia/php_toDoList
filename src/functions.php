<?php 
    session_start();

    function addList($list){
        $lists = isset($_SESSION['lists'])?$_SESSION['lists']:array();
        array_push($lists, $list);
        $_SESSION['lists'] = $lists;
    }

    function displayList(){
        foreach($_SESSION['lists'] as $key=>$value){
            echo '
            <form action="" method = "POST">
                <li>    
                    <input type="checkbox">
                    <label>'.$value.'</label><input type="text">
                    <button class="edit" name="action" value="edit">Edit</button>
                    <button class="delete" name = "action" value = "delete">Delete</button>
                    <input type = "text" hidden name = "hid_val" value = "'.$key.'"> 
                </li>
            </form>';
        } 
    }

?>