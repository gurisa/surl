<?php
  include_once('functions.php');
  if (($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST["links"]))) {
    $links = $_POST["links"];
    $privacy = anti_injection($_POST["iCheck"]);
    $password = anti_injection($_POST["password"]);
    $ours = explode("\n", $links);
    for ($i = 0; $i < count($ours); $i++) {
?>
    <?php if (!empty ($ours[$i])) { $id = short_link($ours[$i], $privacy, $password); } ?>
    <div class="row">
      <div class="<?php if (!empty ($ours[$i])) { echo 'col-md-9'; } else { echo 'col-md-12'; } ?>">
        <div class="shorten-result" id="link-<?php echo $id; ?>">
          <?php if (!empty ($ours[$i])) {  ?>
          <a class="link-white" href="<?php echo get_home_page() . $id; ?>"><?php echo get_home_page() . $id; ?></a>
          <?php } else { echo "Failed to short &rarr; " . $ours[$i]; } ?>
        </div>
      </div>
      <?php if (!empty ($ours[$i])) { ?>
      <div class="col-md-3">
        <button id="copy-link" class="btn btn-success btn-md btn-custom-green" data-clipboard-text="<?php echo get_home_page() . $id; ?>" onclick="copy_to_clipboard('<?php echo $id; ?>');">Copy</button>
        <button id="visit-link" class="btn btn-success btn-md btn-custom-green" onclick="visit_link('<?php echo get_home_page() . $id; ?>');">Visit</button>
      </div>
      <?php } ?>
    </div>
<?php
    }
  }
  else {
    header("Location:index.php");
  }
?>
