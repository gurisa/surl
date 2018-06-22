	<!-- Engine here -->
	<div class="engine row">
		<div class="short-form col-md-8">
			<?php
				if (($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST["links"]))) {
					header("Location:index.php");
				}
				else {
					if (($_SERVER["REQUEST_METHOD"] == "GET") && !empty($_GET["v"]) || !empty($_POST["confirm-password"])) {
						$link = view_short_link($_GET["v"]);
						if ($link) {
			?>

			<h3 class="text-center">Short Link Details</h3>
			<div class="center-block">
			  <table class="link-details table table-hover">
					<tr><td>Title</td><td class="break-word-wrap"><?php echo $link["short_title"]; ?></td></tr>
					<tr><td>Keywords</td><td class="break-word-wrap"><?php echo $link["short_keyword"]; ?></td></tr>
					<tr><td>Description</td><td class="break-word-wrap"><?php echo $link["short_description"]; ?></td></tr>
					<tr><td>Date/Time</td><td class="break-word-wrap"><?php echo $link["short_date"] . "/" . $link["short_time"] ; ?></td></tr>
					<tr><td>Privacy</td><td class="break-word-wrap"><?php echo $link["short_privacy"]; ?></td></tr>
					<?php if (!empty($_POST["confirm-password"]) && check_password($_GET["v"], $_POST["confirm-password"])) { ?>
					<?php } else { ?>
					<?php if (has_password($_GET["v"])) { ?>
					<?php get_page_part('confirm-password-form.php','include','once'); ?>
					<?php } } ?>
			  </table>
			</div>

			<div id="short-content" class="center-block">
				<?php echo $link["short_content"]; ?>
			</div>

			<?php if (has_thumbnails($_GET["v"])) { ?>
			<h4 class="text-center">Thumbnails</h4>
			<div class="thumbnails-link">
				<?php //* get_thumbnails(); ?>
			</div>
			<?php } ?>

			<input type="button" id="go-short-links" class="pull-left btn btn-primary btn-sm btn-custom-blue" value="Short More Links?" />
			<div id="confirmed-password">
			<?php if (!has_password($_GET["v"])) { ?>
				<input type="button" id="unshort-button" class="pull-right btn btn-primary btn-md btn-custom-blue" value="Unshort Link" />
				<input type="button" id="visit-button" class="pull-right btn btn-success btn-md btn-custom-green" value="Visit Link" />
			<?php } else { ?>
			<?php if (!empty($_POST["confirm-password"]) && check_password($_GET["v"], $_POST["confirm-password"])) { ?>
				<input type="button" id="unshort-button" class="pull-right btn btn-primary btn-md btn-custom-blue" value="Unshort Link" />
				<input type="button" id="visit-button" class="pull-right btn btn-success btn-md btn-custom-green" value="Visit Link" />
			<?php } } ?>
			</div>

			<?php
						}
						else {
							header("Location:index.php");
						}
					}
					else {
			?>
			<form role="form" method="POST" action="<?php anti_injection($_SERVER["PHP_SELF"]); ?>" name="short" id="short">
				<div class="col-links form-group">
					<label class="sr-only" for="links">Input Your Links Below :</label>
					<textarea class="form-control" placeholder="Input your links here.." id="links" name="links" cols="45" rows="8" ></textarea>
				</div>
				<div class="form-group">
					<div class="col-privacy col-sm-4">
						<label for="privacy">Privacy :</label>
						<br />
						<label class="radio-inline" for="public">
							<input type="radio" name="iCheck" id="public" value="PUBLIC" checked> Public
						</label>
						<label class="radio-inline" for="private">
							<input type="radio" name="iCheck" id="private" value="PRIVATE"> Private
						</label>
					</div>
					<div class="col-password col-sm-8">
						<label for="password">Password :</label>
						<input type="password" id="password" name="password" class="form-control" placeholder="Add password for your links (optional)." />
					</div>

					<input type="submit" id="short-button" class="pull-right btn btn-primary btn-md btn-custom-blue" value="Short Now" />
				</div>
			</form>

			<div class="clearfix"></div>

			<div class="status-short progress">
				<div class="status-short-progressbar progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
					Please wait a while..
				</div>
			</div>

			<div id="results"></div>

			<div class="short-information">
				<ul type="square">
					<li>You can short up to 10 links at the same time.</li>
					<li>The shorting process could take some time.</li>
					<li>Do not refresh or close this page until the shorting process is done.</li>
					<li>You can add additional password for your link/s, please note that your password will be apply to all of your links.</li>
					<li>If you choose private privacy for your link/s, search engine will not fetch your link/s from us.</li>
				</ul>
			</div>

			<?php
					}
				}
			?>
		</div>
		<div class="widget-right col-md-4">
			<a href="<?php echo get_home_page() ?>advertisment" target="_blank">
				<img src="conf/img/square-ads.gif" class="center-block" alt="Ads Space Available" title="Advertisment" />
			</a>
		</div>
	</div>

	<div class="widget row">
		<div class="col-md-13">
			<a href="<?php echo get_home_page() ?>advertisment" target="_blank">
				<img src="conf/img/horizontal-ads.gif" class="center-block" alt="Ads Space Available" title="Advertisment" />
			</a>
		</div>
	</div>

	<script data-cfasync="false" type="text/javascript" language="javascript">var theme_uri = "<?php echo get_home_page() ?>";</script>
	<?php if (($_SERVER["REQUEST_METHOD"] == "GET") && !empty($_GET["v"]) || !empty($_POST["confirm-password"])) { ?>
	<?php $link = view_short_link($_GET["v"]); if ($link) { ?>
	<script data-cfasync="false" type="text/javascript" language="javascript">var short_id = "<?php echo anti_injection($_GET["v"]); ?>"; </script>
	<?php } } ?>
</div> <!-- End of Container -->
