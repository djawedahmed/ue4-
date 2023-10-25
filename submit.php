<?php

require_once 'inc/template.class.php';
require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/classes.inc.php';

if ((empty($_SERVER['HTTP_X_REQUESTED_WITH']) or strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') or empty($_POST)) {/* Detect AJAX and POST request */
    exit('Unauthorized Acces');
}

# the function responcibale for sending data  to webpage  
if (!empty($_POST) && $_POST['Action'] == 'Get_characters_by_role') {

    $table_id = safe_input($con, $_POST['table_id']);
    $role_data = safe_input($con, $_POST['table_id']);

    $role = safe_input($con, $_POST['role']);

    $character_class = new character();

    switch ($role) {

        case 'table':
            exit($character_class->$characters->CharacterList($table_id));
            break;
            
        case 'role1':

            break;

        default:
            # code...
            break;
    }
}
