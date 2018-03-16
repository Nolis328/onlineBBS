/*js
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
*/

(function($){

CDlgPvBtn = {

	setup : function() {
		if ( this.b_setup ) { return; }
		this.b_setup = true;

		var _this = this;

		if ( !this.jqo_ctar ) {
			this.jqo_ctar = $(".dlgpvbtn");
		}

		this.jqo_tpllist = this.jqo_ctar.find(".dlgpvbtn-tpllist");
		this.jqo_btn_ok = this.jqo_ctar.find(".btn-ok");
		this.jqo_btn_cancel = this.jqo_ctar.find(".btn-cancel");

		this.jqo_tpllist.find(".dlgpvbtn-tplbox")
			.click( function(e){
				_this.pc_ok($(this).attr("data-tid"));
			})
			.keydown(function(e){
				var cc = e.which;
				if (( cc == 13 ) || ( cc == 32 )) {
					e.preventDefault();
					$(this).click();

				}
			});

		this.jqo_ctar.find(".btn-ok")
			.click( function(e){
				e.preventDefault();
				_this.pc_ok();
			});

		this.jqo_ctar.find(".btn-cancel,.btn-close")
			.click( function(e){
				e.preventDefault();
				_this.pc_cancel();
			});

		this.rwin = new CRWindow({
			cwin:this,
			min_w:300,
			max_w:550,
			max_h:500,
			min_h:230
		});
	},

	open : function( opt ) {
		for ( var key in opt ) { this[key] = opt[key]; }
		this.setup( opt );

		//-- open
		this.rwin.open();

		//-- focus
		var jqo = this.jqo_tpllist.find(".dlgpvbtn-tplbox[data-tid='" +
			this.data + "']");
		if ( !jqo.length ) {
			jqo = this.jqo_tpllist.find(".dlgpvbtn-tplbox").first();
		}
		jqo.find(".dlgpvbtn-tplbox-body").focus();
	},

	pc_ok : function( tid ) {
		this.rwin.close();
		if ( this.onOK ) {
			this.onOK( tid );
		}
	},

	pc_cancel : function() {
		this.rwin.close();
		if ( this.onCancel ) {
			this.onCancel();
		}
	},

	onRedraw : function() {
		this.jqo_ctar.css({
			width:this.rwin.jqo_rwin.width() + "px",
			height:this.rwin.jqo_rwin.height() + "px"
		});

		// 50 for heading, 10 for padding, 50 for footer 
		var h = (this.jqo_ctar.height()-(50+10*2+50));
		this.jqo_tpllist.css({
			height:h + "px",
		});
	}
};

}(jQuery));
