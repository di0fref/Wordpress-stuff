jQuery(document).ready(function($) {
	
	$('div#content div[id^=post]').each(function() { 
		var postId = $(this).attr('id');
		$('div#'+postId+' a[href$=".png"]').addClass('fancybox').attr('rel', postId);
		$('div#'+postId+' a[href$=".gif"]').addClass('fancybox').attr('rel', postId);
		$('div#'+postId+' a[href$=".jpg"]').addClass('fancybox').attr('rel', postId);
		$('div#'+postId+' a[href$=".PNG"]').addClass('fancybox').attr('rel', postId);
		$('div#'+postId+' a[href$=".GIF"]').addClass('fancybox').attr('rel', postId);
		$('div#'+postId+' a[href$=".JPG"]').addClass('fancybox').attr('rel', postId)
	});
	
	$('a.fancybox').fancybox({
		'overlayShow' : true,
		'hideOnContentClick': true
		});
		
	$('table tr').removeClass('odd even');
	$('table tr:even').addClass('odd');
	
});
