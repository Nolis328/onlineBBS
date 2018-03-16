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

function CRWindow( opt ) {
	for ( var key in opt ) { this[key] = opt[key]; }
	this.class_rwindow = "rwindow";
	this.class_overlay = "roverlay";
};

CRWindow.prototype = {

	setup : function() {
		if ( this.b_setup ) { return; }
		this.b_setup = true;

		var _this = this;

		this.cwin.jqo_ctar.appendTo("body");

		this.jqo_overlay = $( "<div>" )
			.attr( "class", this.class_overlay )
			.click( function(e) {
				_this.close();
			})
			.appendTo( $('body') );

		this.jqo_rwin = $( "<div>" )
			.attr( "class", this.class_rwindow )
			.click( function(e){
				//-- prevent clicks from
				//-- going down to overlay
				e.stopPropagation();
			})
			.html( this.cwin.jqo_ctar )
			.appendTo( this.jqo_overlay );

		this.cwin.jqo_ctar.show();

		this.resize_handler = function() {
			_this.redraw();
		};
	},

	getViewport : function() {
		var win = $(window);
		return {
			'x':win.scrollLeft(),
			'y':win.scrollTop(),
			'w':win.width(),
			'h':win.height()
		};
	},

	redraw : function() {

		//-- calc min, max 
		this.size = {
			min_w:this.min_w,
			max_w:this.max_w,
			min_h:this.min_h,
			max_h:this.max_h
		};

		//-- overlay
		this.jqo_overlay
			.css( "left", "0" )
			.css( "top", "0" )
			.css( "width", $(window).width() )
			.css( "height", $(window).height() );

		var vp = this.getViewport();

		//-- padding between rwindow and viewport
		var dw = ( vp.w <= 600 ) ? 0 : 10;
		var dh = ( vp.h <= 600 ) ? 0 : 10;

		//-- initial rwindow widht and height
		var dp = {
			w:vp.w - dw*2,
			h:vp.h - dh*2
		};

		//-- calc width from min & max width
		if ( this.size.min_w ) {
			if ( dp.w < this.size.min_w ) {
				dp.w = this.size.min_w;
			}
		}

		if ( this.size.max_w  ) {
			if ( dp.w > this.size.max_w ) {
				dp.w = this.size.max_w;
			}
		}

		//-- calc x-position
		dp.x = vp.x + ( vp.w - dp.w ) / 2;

		//-- calc min & max height
		if ( !this.min_h && !this.max_h ) {

			this.jqo_rwin.css({
				width:dp.w+"px"
			});

			this.cwin.jqo_ctar.addClass("dlg-rel");

			var border_w = 10;
			this.size.min_h = this.size.max_h =
				this.cwin.jqo_ctar.outerHeight(true)+(border_w*2);
 		}

		//-- calc height from min & max height
		if ( this.size.min_h  ) {
			if ( dp.h < this.size.min_h ) {
				dp.h = this.size.min_h;
			}
		}

		if ( this.size.max_h ) {
			if ( dp.h > this.size.max_h ) {
				dp.h = this.size.max_h;
			}
		}

		//-- calc y-position
		var n = 3;// 2,3,4...
		dp.y = ( vp.h - dp.h ) / n;

		//-- set rwindow's width, height, x&y positions
		this.jqo_rwin.css({
			left : dp.x + "px",
			top : dp.y + "px",
			width : dp.w + "px",
			height : dp.h + "px"
		});

		//-- call callback function
		if ( this.cwin.onRedraw ) {
			this.cwin.onRedraw();
		}
	},

	open : function() {
		this.setup();

		this.jqo_overlay.css({"z-index":CZIndex.capture()});
		$( window ).bind( "resize", this.resize_handler );
		this.jqo_overlay.show();

		this.redraw();

		if ( CDuan.canCssAnim() ) {
			this.jqo_rwin
				.removeClass("rwindow-close")
				.addClass("rwindow-open");
		} else {
			this.jqo_rwin
				.css({
					top:"-=30px",
					opacity:0
				})
				.animate({
					top:"+=30px",
					opacity:1
				},300);
		}
	},

	close : function() {
		var _this = this;

		if ( CDuan.canCssAnim() ) {
			this.jqo_rwin
				.removeClass("rwindow-open")
				.addClass("rwindow-close")
				.one("animationend",function(e){
					_this.jqo_overlay.hide();
				});
		} else {
			this.jqo_rwin
				.animate({
					top:"-=30px",
					opacity:0
				},300,function(){
					_this.jqo_overlay.hide();
				});
		}

		$( window ).unbind( "resize", this.resize_handler );
		CZIndex.release();
	}
};

window.CRWindow = CRWindow;

}(jQuery));
