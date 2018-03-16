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

(function(){

function CJMS(){
	this.binding = {};
};

CJMS.prototype = {

	trigger : function( ename, data ) {
		if ( ename in this.binding ) {
			var ls = this.binding[ename];
			for( ele in ls ) {
				var rec = ls[ele];
				rec.func.call(rec.obj,data);
			}
		}
	},

	bind : function( ename, obj, func ) {
		if (!( ename in this.binding )) {
			this.binding[ename] = [];
		}
		this.binding[ename].push({
			obj:obj,
			func:func
		});
	}

};

window.CJMS = CJMS;

}());
