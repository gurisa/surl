<!-- Header here -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a class="menubar" href="<?php echo get_home_page(); ?>">Home</a></li>
          <li><a class="menubar" href="https://www.gurisa.com" target="_blank">Developer</a></li>
        </ul>
      </div>
    </div>
</nav>

<div class="container">

  <div class="header row">
    <div class="col-md-13">
      <a href="index.php">
        <img class="header-logo" src="<?php echo go_gurisa_config('WSLOGO'); ?>" alt="GoGurisa" title="GoGurisa" />
      </a>
      <p class="header-description"><?php echo go_gurisa_config('WSDESC'); ?></p>
    </div>
  </div>

  <div class="widget row">
    <div class="col-md-13">
      <!--
      <a href="/advertisment" target="_blank">
      	<img src="conf/img/horizontal-ads.gif" alt="Ads Space Available" title="Advertisment" />
      </a>
    -->
    </div>
  </div>
