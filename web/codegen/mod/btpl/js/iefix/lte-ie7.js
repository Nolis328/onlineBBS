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

CIE7 = {

	setGlyphicon : function() {
		$('.glyphicon').css('margin','0 3px');
		$('.glyphicon').each(function() {
			var gly = {
				"home":"&#xe021;",
				"search":"&#xe003;",
				"wrench":"&#xe136;",
				"plus-sign":"&#xe081;",
				"th-list":"&#xe012;",
				"pencil":"&#x270f;",
				"question-sign":"&#xe085;",
				"star":"&#xe006;",
				"remove":"&#xe014;",
				"comment":"&#xe111;",
				"align-left":"&#xe052;",
				"list-alt":"&#xe032;",
				"circle-arrow-right":"&#xe131;",
				"th":"&#xe011;",
				"ok-sign":"&#xe084;",
				"tower":"&#xe184;",
				"ban-circle":"&#xe090;",
				"certificate":"&#xe124;",
				"chevron-up":"&#xe113;",
				"chevron-down":"&#xe114;",
				"cog":"&#xe019;",
				"thumbs-up":"&#xe125;",
				"thumbs-down":"&#xe126;"


			};

			var class_name = $(this).attr('class');
			var regExp = /glyphicon-([a-z\-]+)/;
			if ( mx = regExp.exec(class_name) ) {
				var n = mx[1];
				if ( n in gly ) {
					$(this).html(gly[n]);
				}
			}
		});
	}

};

(function($){

$(document).ready(function(){
	CIE7.setGlyphicon();
});

}(jQuery));

