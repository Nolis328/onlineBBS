<div class="psect">
	<div class="psect-heading">
		<div class="cell-title">
			<span class="label-step-r">参考</span>
		</div>
	</div>

	<div class="psect-body">
		<div class="row">
			<div class="col-sm-12">
				<p>
以下に、このいいねボタンを表示するもっともコンパクトなウェブページのソースコードを示します。
				</p>

<?php CInstCode::printDemoHtml(); ?>

				<div style="text-align:center;">
					<form action="<?php echo CApp::vurl('run-demo'); ?>" method="post" target="_blank">
					<input type="hidden" name="iid" value="<?php echo htmlspecialchars($iid); ?>"/>
					<input type="hidden" name="tid" value="<?php echo htmlspecialchars($tid); ?>"/>
					<button class="btn btn-default">
					上記のHTMLを別タブで表示してみる</button>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<?php // ?>