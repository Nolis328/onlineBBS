<div class="psect">
	<div class="psect-heading">
		<div class="cell-step">
			<span class="label-step-g">1</span>
		</div>
		<div class="cell-title">
			&lt;script&gt;タグを貼り付ける
		</div>
	</div>

	<div class="psect-body">
		<div class="row">
			<div class="col-sm-12">
				<p>
<span class="code-hl">以下の一行</span>をコピーして、ホストページ(貼りつけ先のページ)に追加してください。
				</p>

<?php CInstCode::printScriptTag(); ?>

				<p>
ページのどこに置いても動作するのですが、下のように<b>&lt;head&gt;</b>タグの間にいれると、
ロード時の体感スピードが向上します。
				</p>

<?php CInstCode::printScriptTagInHead(); ?>

				<p>
※ この&lt;script&gt;タグの貼り付けは、一ページあたり一回のみ行います。
たとえ複数のいいねボタンを一ページに貼り付ける場合でも、
&lt;script&gt;タグはひとつしか必要ありません。
				</p>

			</div>
		</div>
	</div>
</div>
<?php // ?>