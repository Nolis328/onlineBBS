/*css
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
*/

//-- [polyfill] trim
if (!String.prototype.trim) {
	String.prototype.trim = function () {
		return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
	};
}

//-- [polyfill] JSON
if (!window.JSON) {
	window.JSON = {
		parse: function(sJSON) { return eval('(' + sJSON + ')'); },
		stringify: (function () {
			var toString = Object.prototype.toString;
			var isArray = Array.isArray || function (a) { return toString.call(a) === '[object Array]'; };
			var escMap = {'"': '\\"', '\\': '\\\\', '\b': '\\b', '\f': '\\f', '\n': '\\n', '\r': '\\r', '\t': '\\t'};
			var escFunc = function (m) { return escMap[m] || '\\u' + (m.charCodeAt(0) + 0x10000).toString(16).substr(1); };
			var escRE = /[\\"\u0000-\u001F\u2028\u2029]/g;
			return function stringify(value) {
				if (value == null) {
					return 'null';
				} else if (typeof value === 'number') {
					return isFinite(value) ? value.toString() : 'null';
				} else if (typeof value === 'boolean') {
					return value.toString();
				} else if (typeof value === 'object') {
					if (typeof value.toJSON === 'function') {
						return stringify(value.toJSON());
					} else if (isArray(value)) {
						var res = '[';
						for (var i = 0; i < value.length; i++) {
							res += (i ? ', ' : '') + stringify(value[i]);
						}
						return res + ']';
					} else if (toString.call(value) === '[object Object]') {
						var tmp = [];
						for (var k in value) {
							if (value.hasOwnProperty(k)) {
								tmp.push(stringify(k) + ': ' + stringify(value[k]));
							}
						}
						return '{' + tmp.join(', ') + '}';
					}
				}
				return '"' + value.toString().replace(escRE, escFunc) + '"';
			};
		})()
	};
}

function printError( msg ) {
	console.log( msg );
};

function hsc( s ) {
	return $("<div>").text(s).html();
};

function canCssAnim() {
	var b = false;
	elm = document.createElement("div");
	if ( elm.style.animationName !== undefined ) {
		b = true;
	}
	return b;
};

function ajaxSend( requ, obj, func ) {
	$.ajax({
		type:"POST",
		url:appcfg.url_server,
		data:"requ="+encodeURIComponent(JSON.stringify(requ)),
		dataType:"json",
		success:function(resp){
			func.call(obj,resp);
		},
		error:function( jqXHR, textStatus, errorThrown ){
			var s = "[$.ajax.error]\n";
			s += jqXHR.responseText+"\n";
			s += textStatus+"\n";
			s += errorThrown;
			printError( s );
		}
	});
};

var CFormatter = {

	number_format : function( n ) {
		return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	},

	ffCount : function( cnt, cfmin ) {
		return this.number_format( cnt );
	}
};

function CAjaxIine( opt ) {
	for( var key in opt ) { this[key] = opt[key]; }
	if ( this.jqo_ctar.length ) {
		this.setup();
	}
};

CAjaxIine.prototype = {

	setup :function() {
		var _this = this;
		this.rs = null;

		//-- show info
		if ( appcfg.info ) {
			console.log("INFO","[jQuery version]",$.fn.jquery);
		}

		//-- init
	},

	setupTpl : function( tpl ) {
		var _this = this;
		this.jqo_ctar.html(tpl);

		this.jqo_ctar.find(".aiin-ctar").click(function(e){
			e.preventDefault();
			_this.onClick();
		});
	},

	updateData : function( rs ) {
		if ( !rs ) {
			rs = {cy:0};
		}
		this.rs = rs;
		this.jqo_ctar.find(".aiin-cy")
			.html(CFormatter.ffCount(rs.cy,-1));
	},

	onClick : function() {
		if ( this.rs ) {
			this.rs.cy++;
			CApp.vote(this.iid,"y");
		}
	}

};

var instance_class = CAjaxIine;
var style_id_prefix = "ajax-iine-style-id-";

//-----------------------------------------------------------
// CApp
//-----------------------------------------------------------
var CApp = {

	initApp : function() {
		var _this = this;
		this.wid = 0;
		this.imap = {};
		this.smap = {};

		$(document).ready(function(){
			_this.setup();
		});
	},

	setup : function() {
		var _this = this;

		$("."+appcfg.cls_selector).each(function(){
			_this.setupInstance($(this));
		});

		var iids = [];
		for( iid in this.imap ) {
			iids.push(iid);
		}

		var tids = [];
		for( tid in this.smap ) {
			tids.push(tid);
		}

		if ( iids.length ) {
			var requ = {
				"cmd":"init",
				"iids":iids,
				"tids":tids
			};
			ajaxSend(requ,_this,function(resp){
				if ( resp.result == "OK" ) {
					this.draw(resp);
				} else {
					var s = "[non-OK] " + resp.result;
					printError( s );
				}
			});
		}
	},

	setupInstance : function( jqo ) {
		if ( parseInt(jqo.attr("data-wid")) ) {
			return;
		}

		this.wid++;
		var wid = this.wid;
		jqo.attr("data-wid",wid);

		var iid = jqo.attr("data-iid");
		if ( !iid ) { return; }

		var tid = jqo.attr("data-tid");
		if ( !tid ) { return; }

		var iobj = new instance_class({
			jqo_ctar:jqo,
			wid:wid,
			iid:iid,
			tid:tid
		});
		this.addIMap(iid,iobj);
		this.addSMap(tid,iobj);
	},

	addIMap : function( iid, iobj ) {
		if (!( iid in this.imap )) {
			this.imap[iid] = [];
		}
		this.imap[iid].push(iobj);
	},

	addSMap : function( tid, iobj ) {
		if (!( tid in this.smap )) {
			this.smap[tid] = [];
		}
		this.smap[tid].push(iobj);
	},

	insertCss : function( tid, txt ) {
		var id = style_id_prefix + tid;
		if ( $("#"+id).length == 0  ) {
			var style = document.createElement("style");
			style.type = "text/css";
			style.id = id;
			if (style.styleSheet){
				style.styleSheet.cssText = txt;
			} else {
				style.appendChild(document.createTextNode(txt));
			}
			document.getElementsByTagName("head")[0].appendChild(style);
		}
	},

	updateData : function( iid, rs ) {
		var ls = this.imap[iid];
		for( var i=0; i<ls.length; i++ ) {
			ls[i].updateData(rs);
		}
	},

	draw : function( resp ) {
		for( tid in resp.cssx ) {
			this.insertCss(tid,resp.cssx[tid]);
		}

		for( iid in this.imap ) {
			var ls = this.imap[iid];
			for( var i=0; i<ls.length; i++ ) {
				var iobj = ls[i];
				iobj.setupTpl(resp.tplx[iobj.tid]);
			}
			this.updateData(iid, resp.rsx[iid]);
		}
	},

	vote : function( iid, ans ) {
		var requ = {
			"cmd":"vote",
			"iid":iid,
			"ans":ans
		};
		ajaxSend(requ,this,function(resp){
			if ( resp.result == "OK" ) {
				this.updateData(resp.iid, resp.rs);
			} else {
				var s = "[non-OK] " + resp.result;
				printError( s );
			}
		});
	}

};

CApp.initApp();

window.initAjaxIine = function() {
	CApp.setup();
};
