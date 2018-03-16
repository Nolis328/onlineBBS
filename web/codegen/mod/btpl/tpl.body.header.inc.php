<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
	$url_mod = $this->urlMod();
?>
<header>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container-fluid">

		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">

			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse"
				data-target="#top-menu"
				accesskey="m">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a href="<?php echo CApp::vurl($this->cfg_admin["app-title-link"]); ?>">
			<span class="navbar-brand" style="color:white;">
				<span class="glyphicon glyphicon-th"> </span>
				<span style='font-family:"Arial Black","Arial";'>
				<?php echo $this->lca_app["app:name"]; ?></span>
			</span>
			</a>

		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="top-menu">
			<ul class="nav navbar-nav navbar-right">
				<?php CTopMenu::printMenu( CApp::get( "doc" ) ); ?> 
			</ul>
		</div><!-- /.navbar-collapse -->

	</div><!-- /.container-fluid -->
</nav>
</header>
<!-- /header -->
<?php // ?>