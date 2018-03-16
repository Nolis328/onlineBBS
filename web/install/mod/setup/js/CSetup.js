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

CSetup = {

	jqo_page2 : null,
	jqo_page3 : null,

	init : function( opt ) {
		for ( var key in opt ) { this[key] = opt[key]; }

		var _this = this;

		this.jqo_btn_start = this.jqo_page1.find(".btn-start");

		this.cajax = new CCAjax();
		this.jms = new CJMS();

		//-- start
		this.jqo_btn_start.click( function(e){
			e.preventDefault();
			_this.pc_goto_page2();
		});

	},

	pc_goto_page2 : function() {
		if ( this.jqo_page2 ) {
			this.jqo_page1.hide();
			this.jqo_page2.show();
			this.jqo_page2.find(".ctar-falert").html("");
		} else {
			var requ = {
				cmd:"goto_page2"
			};
			this.cajax.send(requ,this,function(resp){
				if ( CFRes.execute(resp) ) {
					this.jqo_page2 = $("<div>")
						.attr("class","page2")
						.html(resp.html);

					this.jqo_page1
						.after(this.jqo_page2)
						.hide();

					var _this = this;
					this.jqo_page2.find(".btn-back").click( function(e){
						e.preventDefault();
						_this.pc_backto_page1();
					});
					this.jqo_page2.find(".btn-next").click( function(e){
						e.preventDefault();
						_this.pc_goto_page3();
					});
				}
			});
		}
	},

	pc_backto_page1 : function() {
		this.jqo_page1.show();
		this.jqo_page2.hide();
	},

	pc_goto_page3 : function() {
		var requ = {
			cmd:"goto_page3",
			form:CForm.get(this.jqo_page2)
		};
		this.cajax.send(requ,this,function(resp){
			if ( CFRes.execute(resp,this.jqo_page2) ) {
				this.jqo_page3 = $("<div>")
					.attr("class","page3")
					.html(resp.html);

				this.jqo_page2
					.after(this.jqo_page3)
					.hide();
			}
		});
	}

};

$(document).ready(function(){
	CSetup.init({ jqo_page1: $(".page1") });
});

}(jQuery));
