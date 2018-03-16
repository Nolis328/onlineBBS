<div class="psect">
	<div class="psect-heading">
		<div class="cell-step">
			<span class="label-step">1</span>
		</div>
		<div class="cell-title">
			いいねボタンのKeyを指定する
		</div>
	</div>
	<div class="psect-body">

		<div class="row">
			<div class="col-sm-12">
				<p>
いいねボタンのKeyを入力してください。
Keyはいいねボタンの名前のようなものです。
ユニークな文字列ならば、なんでもかまいません。
				</p>

				<div class="form-group">
					<label>Key:</label>
					<input type="text" class="form-control _ffe_" name="iid"
						value="" placeholder="(例) abcdef123456" maxlength="300" />
					<div style="text-align:right;">
						<button class="btn btn-sm btn-info btn-gen-iid">
						ランダムにKeyを生成する</button>
					</div>
				</div>

				<p>
Keyは、いいねボタンの投票数と関連付けて、データベースに記録されます。
従って、同じKeyを持ついいねボタンは同じ投票数を表示します。
				</p>

				<p>
今ではなく、ウエブページに貼り付ける時に、Keyを指定してもかまいません。その場合は下のボタンをクリックして備忘録を入力しておいてください。
				</p>

				<p>
					<button class="btn btn-default btn-enter-memo">
					備忘録を入力しておく</button>
				</p>
			</div>
		</div>
	</div>
</div>
<?php // ?>