/*
	Require script.aculo.us
*/
// Get current year as default
var path = "/wordpress/wp-content/plugins/archiver";
var url = path + "/arc.php";
var indicator = "<img src='" + path + "/images/indicator.gif' />";
var div = "";
var $j = jQuery.noConflict();

$j(document).ready(function() {	
	$j(".year").click(function(event){
		event.preventDefault();
		get(event.currentTarget.id);
		console.log(event);
	});
		
});

function get(id){
	var curl = url + "?what=" + "blog" + "&year=" + id;
	var pars = "year=" + id;
	
	$j("#"+id).load(curl);
}


