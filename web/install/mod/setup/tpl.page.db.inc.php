<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
	$rs["db-hostname"] = "localhost";
	$rs["db-database"] = "";
	$rs["db-username"] = "";
	$rs["db-password"] = "";

	$lca_ai = CEnv::locale("app/info");
	$lca = CEnv::locale("install/page.db");

	$req = _req();
?>
<div class="psect">
	<div class="psect-body">
		<div class="ctar-form">
			<p class="instruction text-info">
				<?php echo $lca["text:inst"]; ?>
			</p>

			<div class="ctar-falert"></div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:db-hostname"]; ?>
							<?php echo $req; ?></label>
						<input type="text"
							class="form-control _ffe_"
							name="db-hostname"
							value="<?php echo _hsc( $rs["db-hostname"] ); ?>"
							placeholder="<?php echo $lca["plh:db-hostname"]; ?>"
							>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:db-database"]; ?>
							<?php echo $req; ?></label>
						<input type="text"
							class="form-control _ffe_"
							name="db-database"
							value="<?php echo _hsc( $rs["db-database"] ); ?>"
							placeholder="<?php echo $lca["plh:db-database"]; ?>"
							>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:db-username"]; ?>
							<?php echo $req; ?></label>
						<input type="text"
							class="form-control _ffe_"
							name="db-username"
							value="<?php echo _hsc( $rs["db-username"] ); ?>"
							placeholder="<?php echo $lca["plh:db-username"]; ?>"
							>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label><?php echo $lca["label:db-password"]; ?>
							<?php echo $req; ?></label>
						<input type="text"
							class="form-control _ffe_"
							name="db-password"
							value="<?php echo _hsc( $rs["db-password"] ); ?>"
							placeholder="<?php echo $lca["plh:db-password"]; ?>"
							>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="psect-footer" style="height:100px;border:0;">
		<button class="btn btn-lg btn-default btn-back pull-left"><?php
			echo $lca["label:back"]; ?></button>
		<button class="btn btn-lg btn-primary btn-next pull-right"><?php
			echo $lca["label:next"]; ?></button>
	</div>
</div>
<?php // ?>