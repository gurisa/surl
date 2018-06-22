<?php if (($_SERVER["REQUEST_METHOD"] == "GET") && !empty($_GET["v"]) || !empty($_POST["confirm-password"])) { ?>
<tr><td class="break-word-wrap" colspan="2" id="form-password-link">
  <form role="form" method="POST" action="<?php anti_injection($_SERVER["PHP_SELF"]); ?>" name="short-password" id="short-password" >
    <div class="form-group">
      <label for="password" class="sr-only">Password :</label>
      <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Type your password here to unlock the link." />
      <input type="submit" id="confirm-button" class="btn btn-danger btn-sm btn-custom-red pull-right" value="Confirm" />
    </div>
  </form>
</td></tr>
<?php } ?>
