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

CCodeGen = {

	createRandomString : function ( n ) {
		var s = "";
		var pat = "abcdefghijklmnopqrstuvwxyz0123456789";

		for( var i=0; i < n; i++ ) {
			s += pat.charAt(Math.floor(Math.random() * pat.length));
		}

		return s;
	},

	init : function( opt ) {
		for ( var key in opt ) { this[key] = opt[key]; }

		var _this = this;

		this.jqo_ctar_form = this.jqo_ctar.find(".ctar-form");
		this.jqo_iid = this.jqo_ctar.find("input[name='iid']");
		this.jqo_btn_gen_iid = this.jqo_ctar.find(".btn-gen-iid");
		this.jqo_btn_enter_memo = this.jqo_ctar.find(".btn-enter-memo");
		this.jqo_btn_gen_code = this.jqo_ctar.find(".btn-gen-code");

		this.cajax = new CCAjax();

		this.jqo_btn_gen_iid.click(function(e){
			e.preventDefault();
			_this.pc_btn_gen_iid();
		});

		this.jqo_btn_enter_memo.click(function(e){
			e.preventDefault();
			_this.pc_btn_enter_memo();
		});

		this.jqo_btn_gen_code.click(function(e){
			e.preventDefault();
			_this.pc_btn_gen_code();
		});

		//-- page init
		CPageStack.init(this.jqo_ctar);

		//-- init components
		initCInpPvBtn();
	},

	setIidInputBox : function( str ) {
		this.jqo_ctar.find("input[name='iid']")
			.val(str)
			.select()
			.addClass("blink");

		var _this = this;
		setTimeout(function(){
			_this.jqo_ctar.find("input[name='iid']")
				.removeClass("blink");
		},1000);
	},

	pc_btn_gen_iid : function() {
		var str = this.createRandomString(20);
		this.setIidInputBox(str);
	},

	pc_btn_enter_memo : function() {
		var str = "備忘録:Keyをここに書き込む";
		this.setIidInputBox(str);
	},

	pc_btn_gen_code : function() {
		var form = CForm.get(this.jqo_ctar_form);
		var requ = {
			cmd:"gen_code",
			form:form
		};
		this.cajax.send(requ,this,function(resp){
			if ( CFRes.execute(resp,this.jqo_ctar_form) ) {
				var jqo = CPageStack.pushPage( resp.html );

				var _this = this;
				jqo.find(".btn-back").click( function(e){
					e.preventDefault();
					CPageStack.popPage();
				});
			}
		});
	}

};

$(document).ready(function(){
	CCodeGen.init({jqo_ctar:$(".spage-front")});
});

}(jQuery));
