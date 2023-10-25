<?php

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/template.class.php';
require_once 'inc/classes.inc.php';
// load charatcters class
$characters = new characters();

// return tags data
$tags_inputs = '';
$tags_data = get_query_contents('SELECT * FROM filters');
foreach ($tags_data as $tag) {
    $tags_input_html = new HtmlPage();
    $tags_input_html->load('templates/tags_input.html');
    $tags_input_html->Process($tag);
    $tags_inputs .= $tags_input_html->GetHtml();
}

// load html page class
$home_page = new HtmlPage();
$home_page->Load('templates/index.html');
$home_page->Process([
'title' => 'Real Engine Setup',
'characters_left_menu' => $characters->CharacterList(1),
'filters' => $tags_inputs,
]);

echo $home_page->GetHtml();
