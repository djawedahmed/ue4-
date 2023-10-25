<?php

// require tampating class to siparate html from php
require_once 'inc/template.class.php';
// require classes for using OOP an colecting data
require_once 'inc/classes.inc.php';
// require database config file
require_once 'inc/config.php';



$c_data = get_query_content("SELECT * FROM character_a WHERE id = 5");
        print_r($c_data);
        echo $c_data['character_data'];



