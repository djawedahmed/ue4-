<?php

# secure data from sql injection
function safe_input($con, $data)
{
  return htmlspecialchars(mysqli_real_escape_string($con, trim($data)));
}

#  
function output($Return = array())
{
  /*Set response header*/
  // header("Access-Control-Allow-Origin: *");
  //header("Content-Type: application/json; charset=UTF-8");
  /*Final JSON response*/
  exit(json_encode($Return));
}

# Function to get users data
function get_user_data($con, $user_id)
{

  $result = mysqli_query($con, "SELECT U.*, P.name FROM tbl_users U LEFT JOIN tbl_user_profile P ON U.user_ID=P.user_id WHERE U.user_id='$user_id' LIMIT 1");
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  } else {
    return FALSE;
  }
}

# defind base url 
function base_url($slug)
{

  echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . "/" . $slug;
}

# generate seo friendly url for better ranking  
function seo_friendly_url($url)
{
  if (isArabic($url) == false) {
    $before = array(
      'àáâãäåòóôõöøèéêëðçìíîïùúûüñšž',
      '/[^a-z0-9\s]/',
      array('/\s/', '/--+/', '/---+/')
    );

    $after = array(
      'aaaaaaooooooeeeeeciiiiuuuunsz',
      '',
      '-'
    );
    $url = str_replace('é', 'e', $url);
    $url = preg_replace('~<div ^="" a-z0-9_="a-z0-9_"></div>~', ' ', $url);
    $url = html_entity_decode($url);
    $url = mb_strtolower($url, 'UTF-8');
    $url = strtr($url, $before[0], $after[0]);
    $url = preg_replace($before[1], $after[1], $url);
    $url = trim($url);
    $url = preg_replace($before[2], $after[2], $url);
    return $url;
  } else {
    $url = str_replace(' ', '-', $url);
    return $url;
  }
}

# cheking if seo_url exist
function seo_url_checker($table, $seo_url)
{
  require('config.php');
  $sql = "SELECT * FROM $table WHERE seo_url ='$seo_url' ";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    return true;
  } else {
    return false;
  }
}

# return data that associated with the seo url 
function get_content($table, $seo_url)
{
  $row = array();
  require('config.php');
  /*--extraction device_Id from db--*/
  $sql = "SELECT * FROM $table  WHERE  seo_url = '$seo_url'  ";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  }
  return $row;
}

# return data that associated with the id 
function get_content_byvalue($table, $colom, $value)
{
  $row = array();
  require('config.php');
  /*--extraction device_Id from db--*/
  $sql = "SELECT * FROM $table  WHERE  $colom = '$value'  ";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  }
  return $row;
}
# return data from a query for one row
function get_query_content($sql)
{
  $row = array();
  require('config.php');
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
  }
  return $row;
  $con->close();
}
# return data from query for multipule rows

function get_query_contents($sql)
{
  require('config.php');
  $data = array();
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }
  return $data;
}
# return true or false  for query action 
function sql_query($sql)
{
  require('config.php');

  if ($con->query($sql) === TRUE) {
    return true;
  } else {
    return false;
  }
  $conn->close();
}

# is arabic 
function isArabic($string)
{
  // Initializing count variables with zero
  $arabicCount = 0;
  $englishCount = 0;
  // Getting the cleanest String without any number or Brackets or Hyphen
  $noNumbers = preg_replace('/[0-9]+/', '', $string);
  $noBracketsHyphen = array('(', ')', '-');
  $clean = trim(str_replace($noBracketsHyphen, '', $noNumbers));
  // After Getting the clean string, splitting it by space to get the total entered words 
  $array = explode(" ", $clean); // $array contain the words that was entered by the user
  foreach ($array as $value) {
    // Checking either word is Arabic or not
    $checkLang = preg_match('/\p{Arabic}/u', $value);
    if ($checkLang == 1) {
      ++$arabicCount;
    } else {
      ++$englishCount;
    }
  }
  if ($arabicCount >= $englishCount) {
    // Return 1 means TRUE i-e Arabic
    return 1;
  } else {
    // Return 0 means FALSE i-e English
    return 0;
  }
}

# limit string carachters to spicific lenght
function limit_carachters($x, $length)
{
  if(strlen($x)<=$length)
  {
    return $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
   return $y;
  }
}
