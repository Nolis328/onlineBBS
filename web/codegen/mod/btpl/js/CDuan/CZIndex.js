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

CZIndex = {

	stack : [0],
	inc_first : 10000,
	inc_other : 1,

	currentZ : function() {
		return this.stack[this.stack.length-1];
	},

	capture : function() {
		var inc = this.inc_other;
		if ( this.stack.length == 1 ) {
			inc = this.inc_first;
		}
		var z_index = this.stack[this.stack.length-1]+inc;
		this.stack.push(z_index);
		return z_index;
	},

	release : function() {
		this.stack.pop();
	}
};
