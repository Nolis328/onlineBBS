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

CBreadcrumb = {

	bc : [],

	findBreakIdx : function ( bc ) {
		for ( var i=0; i<bc.length; i++ ) {
			if (( i >= this.bc.length ) ||
				( bc[i] != this.bc[i] )) {
				return i;
			}
		}
		return i;
	},

	getDrops : function ( idx ) {
		var jqo_bc = $(".ctar-bcrumb");
		var i = idx;
		var jqo_total = $();
		do {
			var jqo = jqo_bc.find(".bcrumb-item[data-id='"+i+"']");
			if ( jqo.length ) {
				if ( i > 0 ) {
					jqo_total = jqo_total.add(jqo_bc
						.find(".bcrumb-item[data-id='"+i+"a']"));
					jqo_total = jqo_total.add(jqo);
				}
				i++;
			}
		} while( jqo.length );

		return jqo_total;
	},

	getAddNew : function ( idx, bc ) {
		var jqo_total = $();
		for ( var i=idx; i<bc.length; i++ ) {
			if ( i > 0 ) {
				jqo_total = jqo_total.add($("<div>")
					.attr("class","bcrumb-item")
					.attr("data-id",i+"a")
					.html($("<span>")
						.attr("class","glyphicon glyphicon-play " +
							"bcrumb-arrow")
					)
				);
			}
			jqo_total = jqo_total.add($("<div>")
				.attr("class","bcrumb-item")
				.attr("data-id",i)
				.html(bc[i])
			);
		}

		return jqo_total;
	},

	write : function ( bc ) {
		var jqo_bc = $(".ctar-bcrumb");

		if ( typeof bc === "string" ) {
			bc = bc.split("\/");
		}

		var bidx = this.findBreakIdx(bc);

		var jqo_drops = null;
		var jqo_addnew = null;

		if ( bidx < this.bc.length ) {
			jqo_drops = this.getDrops(bidx);
		}
		if ( bidx < bc.length ) {
			jqo_addnew = this.getAddNew(bidx,bc);
		}

		var b_css_anim = CDuan.canCssAnim();
		setTimeout(function(){
			if ( jqo_drops ) {
				jqo_drops.each(function(){
					if ( b_css_anim ) {
						$(this)
							.removeClass("bcrumb-addnew")
							.addClass("bcrumb-drop")
							.one("animationend",function(){
								$(this).remove();
							});
					} else {
						$(this)
							.animate({
								opacity:0,
								top:"-=50px"
							},300,function(){
								$(this).remove();
							});
					}
				});
			}

			if ( jqo_addnew ) {
				setTimeout(function(){
					jqo_addnew.each(function(){
						$(this).appendTo(jqo_bc)
						if ( b_css_anim ) {
							$(this).addClass("bcrumb-addnew");
						} else {
							$(this)
								.css({
									opacity:0,
									position:"relative",
									top:"-=50px"
								})
								.animate({
									opacity:1,
									top:"+=50px"
								},300);
						}
					});
				},500);
			}
		},100);

		this.bc = bc;
	}

};

