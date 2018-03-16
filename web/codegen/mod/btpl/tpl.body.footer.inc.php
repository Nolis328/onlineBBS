<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
?>
<!-- footer -->
<footer>
<style>
footer {
	text-align:center;
}
.site-name-container {
	display:inline-block;
	*zoom:1;
	*display:inline;
	margin:5px 0;
}
.site-name {
	font-family:"Arial Black","Arial";
	font-size:14px;
	font-weight:normal;
	color:#666;
}
.site-name:hover {
	animation-name:kf-site-name-hover;
	animation-duration:1.0s;
	animation-timing-function:ease;
	animation-iteration-count:infinite;
}
@keyframes kf-site-name-hover {
	0% {
		color:#5cb85c;
	}
	33% {
		color:#5c5cb8;
	}
	66% {
		color:#b85c5c;
	}
	100% {
		color:#5cb85c;
	}
}
</style>

<?php
	$lca = CEnv::locale("app/info");
?>
<div class="site-name-container"><span class="site-name btn-a"
	data-href="<?php echo $lca["site:url"]; ?>" data-target="_blank"
	style="cursor: pointer;"><?php echo $lca["site:name"]; ?></span></div>

</footer>
<!-- /footer -->
<?php // ?>