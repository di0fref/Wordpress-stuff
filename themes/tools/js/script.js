var $j = jQuery.noConflict();
$j(document).ready(function(){
	
	
	$j('.has_icon').prepend('<div class="icon"></div>');
	$j("#nav li a").corner("5px");
	$j(".comment_body").corner("5px");
	$j(".comment_author").corner("5px");
		
 	/*var $sidebar   = $j("#sidebar"),
        $window    = $j(window),
        offset     = $sidebar.offset(),
        topPadding = 15;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            },"fast");
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            },"fast");
        }
    });

	*/
});

Cufon.replace('h3');
Cufon.replace('h2');
