<?php
require_once('functions.php');
#replacing data in html template
class HtmlPage
{
    private $html, $header, $footer, $content;
    # loads header templates file into header 
    public function LoadHeader($template)
    {
        if (!file_exists($template)) {
            echo "Specified template ($template) does not exist.";
            return false;
        }
        $this->header =  file_get_contents($template);
        return true;
    }
    # loads footer templates file into $footer
    public function LoadFooter($template)
    {
        if (!file_exists($template)) {
            echo "Specified template ($template) does not exist.";
            return false;
        }
        $this->footer =  file_get_contents($template);
        return true;
    }


    # Loads specified template file into $html
    public function Load($template)
    {
        if (!file_exists($template)) {
            echo "Specified template ($template) does not exist.";
            return false;
        }
        $this->content =  file_get_contents($template);
        return true;
    }

    # Takes in an array of data, key is the placeholder replaced, value is the new text
    public function Process($data_array)
    {
        $this->html = $this->header . $this->content . $this->footer;
        if (!is_array($data_array)) return;

        foreach ($data_array as $search => $replace) {
            # Add brackets so they don't have to be manually typed out when calling HtmlPage::Process()
            $search = '{{' . $search . '}}';

            $this->html = str_replace($search, $replace, $this->html);
        }
    }

    # Returns the page
    public function GetHtml()
    {
        return $this->html;
    }
}
