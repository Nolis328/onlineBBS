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
<div class="psect">
	<div class="psect-heading">
		<div class="cell-step">
			<span class="label-step">2</span>
		</div>
		<div class="cell-title">
			いいねボタンのスタイル・テンプレートを選択する
		</div>
	</div>
	<div class="psect-body">

		<div class="row">
			<div class="col-sm-12">
				<p>
<b>テンプレートの選択</b>をクリックして、いいねボタンのスタイル・テンプレートを選択してください。
				</p>

				<div class="form-group">
					<div class="inppvbtn-preview">
						<div class="inppvbtn-preview-inner"></div>
						<span class="inppvbtn-tid">x</span>
					</div>
					<div style="text-align:center;">
						<button class="btn btn-default btn-inppvbtn-sel-tpl">
						テンプレートの選択</button>
					</div>
					<?php
						CTpl::getAllTplNames( $tpls );
						$first_key = key($tpls);
					?>
					<input type="text" class="inppvbtn _ffe_" name="tid"
						value="<?php echo $first_key; ?>" />
				</div>

			</div>
		</div>
	</div>
</div>
<?php // ?>