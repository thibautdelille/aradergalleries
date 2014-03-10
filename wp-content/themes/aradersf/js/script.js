$(document).ready(function() {
	$('.thumb img').each(function(){
			$(this).hover(function(e) {
				var parent = $(this).parent().parent().parent();
				$('.title', parent).addClass('hover');
				var parentH = $(this).parent().parent().height();
				var width = $(this).attr('widthhover');
				var height = $(this).attr('heighthover');
				var top = (parentH - parseInt($(this).attr('heighthover')))/2;
				$(this).hoverFlow(e.type, { 'width': width, 'height': height, 'margin-top':top+'px' }, 50)
				
				
			}, function(e) {
				var parent = $(this).parent().parent().parent();
				$('.title', parent).removeClass('hover');
				var parentH = $(this).parent().parent().height();
				var width = $(this).attr('widthinit');
				var height = $(this).attr('heightinit');
				var top = (parentH - parseInt($(this).attr('heightinit')))/2;
				$(this).hoverFlow(e.type, { width: width, height: height, 'margin-top':top+'px' }, 50)
			});
		//});
	});
	/*$('.piece-wrap .image img').each(function(){
		var imgW = $(this).width();
		var imgH = $(this).height();
		$(this).attr('width', 460);
		$(this).attr('height', imgH*$(this).width()/imgW);
	});*/
	$('#s').focus(function(){
		if($(this).attr('value')==$(this).attr('defaultValue')){
			$(this).attr('value', "");
		}
	});
	
	$('#s').focusout(function(){
		if($(this).attr('value')==""){
			$(this).attr('value', $(this).attr('defaultValue'));
		}
	});
});

WebFontConfig = {
    google: { families: [ 'Alegreya:400,400italic,700,700italic,900,900italic:latin,latin-ext' ] }
};
(function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();
