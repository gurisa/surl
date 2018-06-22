<?php
  include_once('functions.php');
  if (($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST["confirm-password"])) && (!empty($_POST["id-link"]))) {
    $id = $_POST["id-link"];
    $confirm_password = $_POST["confirm-password"];
    if (check_password($id, $confirm_password)) {
?>
      <input type="button" id="unshort-button" class="pull-right btn btn-primary btn-md btn-custom-blue" value="Unshort Link" />
      <input type="button" id="visit-button" class="pull-right btn btn-success btn-md btn-custom-green" value="Visit Link" />
<?php
    }
    else {
      echo "";//leave blank, we will try isEmpty function in js!
    }
  }
  else {
    header("Location:index.php");
  }
?>
