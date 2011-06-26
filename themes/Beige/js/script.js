$(document).ready(function() {  
      
    // Check for hash value in URL  
    var hash = window.location.hash.substr(1); 
     //alert(hash);
    var href = $('#menu li a').each(function(){  
        
        var string = $(this).attr('href'); 
		var getit = new Array(); 
		getit = string.split("fahlstad/"); 
		var result = getit[1].substr(0, getit[1].length-1);
        
       // alert(href.substr(0, href.length-1) + " :: " + hash);
        if(hash == result){  
            var toLoad = hash + " #content";  
            $('#content').load(toLoad)  
        }   
    });  
      
    $('#menu li a').click(function(){  
      
    var toLoad = $(this).attr('href')+' #content';  
    $('#content').hide('fast',loadContent);  
    $('#load').remove();  
    $('#wrap').append('<span id="load">LOADING...</span>');  
    $('#load').fadeIn('normal');  
    
    var string = $(this).attr('href'); 
	var getit = new Array(); 
	getit = string.split("fahlstad/"); 
	var result = getit[1].substr(0, getit[1].length-1);
    
    
    window.location.hash = result;//$(this).attr('href').substr(0,$(this).attr('href').length);
    
    function loadContent() {  
        $('#content').load(toLoad,'',showNewContent())  
    }  
    function showNewContent() {  
        $('#content').show('normal',hideLoader());  
    }  
    function hideLoader() {  
        $('#load').fadeOut('normal');  
    }  
    return false;  
      
    });  
});  