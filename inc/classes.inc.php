<?php

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/template.class.php';

/* ------------------------------------ characters class------------------------------------------- */
// all operations on characters
class characters
{
    // get characters List with li html wrap
    public function CharacterList($id)
    {
        $characters = '';
        $characters_data = get_query_contents("SELECT * FROM characters WHERE table_id = $id");
        foreach ($characters_data as $character) {
            $characters_html = new HtmlPage();
            $characters_html->load('templates/character_template.html');
            $characters_html->Process(array_merge(['character_data_html' => $this->CharacterDataList($character['character_data']), 'tags_data' => json_encode($character['tags'], JSON_FORCE_OBJECT)], $character));
            $characters .= $characters_html->GetHtml();
        }

        return $characters;
    }

    // get character data list wraped in li html wrap
    public function CharacterDataList($character_datas)
    {
        $allcharacterdata = '';

        $character_data = json_decode($character_datas, true);
        if ($character_data !== null) {
            foreach ($character_data as $data) {
                $character_data_html = new HtmlPage();
                $character_data_html->load('templates/character_data_template.html');
                $character_data_html->Process($data);
                $allcharacterdata .= $character_data_html->GetHtml();
            }

            return $allcharacterdata;
        }
    }

    // add character function
    public function CharacterTags($character_tags_data)
    {
        $tags = '';
        if (!empty($character_tags_data)) {
            foreach (json_decode($character_tags_data) as $tag) {
                $tags .= '#'.get_query_content("SELECT * FROM filters  WHERE  id = $tag")['filter_name'].'  ';
            }
        }

        return $tags;
    }
}

/* ------------------------------------ end of characters class------------------------------------------- */
