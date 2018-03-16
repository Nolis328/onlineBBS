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

function CInpPvBtn( opt ) {
	for( var key in opt ) { this[key] = opt[key]; }
	this.setup();
};

CInpPvBtn.prototype = {

	setup : function() {
		var _this = this;

		var jqo_prt = this.jqo_inp.parents(".form-group")
		this.jqo_preview = jqo_prt.find(".inppvbtn-preview");
		this.jqo_inner = this.jqo_preview.find(".inppvbtn-preview-inner");
		this.jqo_tid = this.jqo_preview.find(".inppvbtn-tid");
		this.jqo_btn_sel_tpl = jqo_prt.find(".btn-inppvbtn-sel-tpl");

		this.jqo_btn_sel_tpl
			.click(function(e){
				e.preventDefault();
				CDlgPvBtn.open({
					jqo_ctar:$(".dlgpvbtn"),
					data:_this.data,
					onOK:function( data ){
						_this.pc_ok(data);
					},
					onCancel:function(){
						_this.jqo_preview.focus();
					}
				});
			});
		this.jqo_inner
			.click(function(e){
				_this.jqo_btn_sel_tpl.click();
			});
	},

	pc_ok : function( data ) {
		this.setVal(data);
		var jqo = this.jqo_preview;
		jqo
			.focus()
			.addClass("inppvbtn-preview-flash");
		setTimeout(function(){
			jqo.removeClass("inppvbtn-preview-flash");
		},2000);
	},

	updatePreview : function() {
		var jqo = $(".dlgpvbtn-tplbox[data-tid='"+this.data+"']")
			.find(".aiin-ctar")
			.clone();
		this.jqo_inner.html(jqo);
		this.jqo_tid.html(this.data);
	},

	setVal : function(data) {
		this.setData(data);
		this.updateInput();
		this.updatePreview();
	},

	setData : function( data ) {
		this.data = data;
	},

	setDataFromFFE : function() {
		this.setData(this.jqo_inp.val().trim());
		this.updatePreview();
	},

	updateInput : function() {
		this.jqo_inp.val(this.data);
	}

};

window.initCInpPvBtn = function() {
	$(".inppvbtn").each( function(){
		if ( !$(this).data("_obj_") ) {
			var obj = new CInpPvBtn({jqo_inp:$(this)});
			obj.setDataFromFFE();
			$(this).data("_obj_",obj);
		}
	});
};

}(jQuery));
