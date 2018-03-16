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

CPageStack = {

	stack : [],
	b_pop_on_next_push : false,

	init : function( jqo_main, breadcrumb ) {
		if ( jqo_main == null ) {
			jqo_main = $(".main-container");
		}
		this.stack.push({
			jqo:jqo_main,
			breadcrumb:breadcrumb
		});
		if ( breadcrumb ) {
			CBreadcrumb.write(breadcrumb);
		}
	},

	pushPage : function( html, breadcrumb ) {
		if ( this.b_pop_on_next_push ) {
			this.popPage();
			this.b_pop_on_next_push = false;
		}

		var rec_curr = this.stack[this.stack.length-1]
		rec_curr.jqo_focus = $(document.activeElement);
		var jqo_curr = rec_curr.jqo;

		jqo_curr.before(html);
		jqo_new = jqo_curr.prev();
		jqo_new.show();

		this.stack.push({
			jqo:jqo_new,
			breadcrumb:breadcrumb
		});

		window.scrollTo(0,0);
		if ( breadcrumb ) {
			CBreadcrumb.write(breadcrumb);
		}

		//-- prevent flicker
		setTimeout(function(){
			jqo_curr.hide();
		},100);

		return jqo_new;
	},

	popPageOnNextPush : function() {
		this.b_pop_on_next_push = true;
	},

	popPage : function() {
		var rec = this.stack.pop();
		rec.jqo.remove();

		var rec = this.stack[this.stack.length-1];
		rec.jqo.show();
		if ( rec.breadcrumb ) {
			CBreadcrumb.write(rec.breadcrumb);
		}
		rec.jqo_focus.focus();

		CScrollBtn.update();
	}

};

}(jQuery));
