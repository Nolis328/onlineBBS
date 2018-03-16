<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
	$lca_ai = CEnv::locale("app/info");
	$lca = CEnv::locale("install/page.done");
?>
<div class="psect psect-done">
	<div class="psect-body">
		<div class="ctar-form">
			<div class="inst-done">
				<?php echo $lca["inst-success"]; ?>
			</div>

			<div class="important-box">
				<div class="important"><?php echo $lca["important-title"]; ?></div>
				<?php echo $lca["important-message"]; ?>
			</div>

			<p class="instruction" style="font-size:120%;">
				<?php 
					$s = $lca["log-in-to-admin"];
					$s = str_replace( "%app-name%", $lca_ai["app:name"], $s );
					$s = str_replace( "%url-admin%", CEnv::urlAdmin(), $s );
					echo $s;
				?>
			</p>

			<div style="margin-top:40px"></div>

			<?php if (0): ?>
			<div class="login-info-box">
				<table>
				<tr>
					<td class="key"><?php echo $lca["username"]; ?> : </td>
					<td class="val"><?php echo "admin"; ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo $lca["password"]; ?> : </td>
					<td class="val"><?php echo "password"; ?></td>
				</tr>
				</table>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php // ?>