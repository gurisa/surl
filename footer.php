	<div class="footer row">
		<div class="col-md-5 break-word-wrap">
			<a class="go-title" title="<?php echo go_gurisa_config('WSNAME'); ?>" href="<?php echo get_home_page(); ?>"><?php echo go_gurisa_config('WSNAME'); ?></a>
			<p class="copyright">
				Developed by : Raka Suryaardi Widjaja <br />
				Copyright &copy; 2016 <a class="link-white" href="https://www.gurisa.com" target="_blank">Gurisa.Com</a> All Rights Reserved.
			</p>
		</div>

		<div class="col-md-3 break-word-wrap">
			<p class="footer-title">Sitemap</p>
			<a class="link-white" href="<?php echo get_home_page(); ?>" title="Home">Home</a>
			<hr class="sitemap" />
			<a class="link-white" href="https://www.gurisa.com" title="Developer" target="_blank">Developer</a>
			<hr class="sitemap" />
		</div>

		<div class="col-md-4 break-word-wrap">
			<p class="footer-title">New Links</p>
			<?php if (check_short_links()) { $shorts = get_short_links(); ?>
				<ul type="square">
				<?php for ($i = 0; $i < count($shorts); $i++) { ?>
					<li><a class="link-white" href="<?php echo $shorts[$i]['short_id']; ?>" title="<?php echo $shorts[$i]['short_title']; ?>"><?php echo $shorts[$i]['short_title']; ?></a></li>
				<?php } ?>
				</ul>
			<?php } else { ?>
				<p class="link-white">
					There are no shorts url founds!<br />
					This probably caused by :
					<ul class="shorted-links link-white" type="square">
						<li>Short url currently not exists</li>
						<li>Short url has private privacys</li>
					</ul>
				</p>
			<?php } ?>
		</div>
	</div>



<!-- Load JavaScript -->
<script data-cfasync="false" src="<?php echo get_home_page(); ?>conf/src/bootstrap/js/jquery.js" language="JavaScript"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>conf/src/bootstrap/js/bootstrap.js" language="JavaScript"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>conf/src/sweetalert/sweetalert-dev.js" language="JavaScript"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>config.js" type="text/javascript" language="javascript"></script>
<!-- jQuery first and then, icheck. -->
<script data-cfasync="false" src="<?php echo get_home_page(); ?>conf/src/icheck/icheck.js" language="JavaScript"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>conf/src/clipboard/clipboard.js" language="JavaScript"></script>
