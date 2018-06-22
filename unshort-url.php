<?php
  include_once('functions.php');
  if (($_SERVER["REQUEST_METHOD"] == "GET") && (!empty($_GET["v"]))) {
    $link = view_short_link($_GET["v"]);
    if ($link) {
      echo $link["short_url"];
    }
    else {
      echo " ";
    }
  }
  else {
    echo " ";
  }
?>
