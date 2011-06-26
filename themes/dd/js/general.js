function activateSearch() {
    if ($('searchform')) {
        $('s').value = 'Start Your Search...'; // Default text in the search box
        var o = document.createElement('div'); // Old search results div
        var n = document.createElement('div'); // New search results div
        $('searchform').onsubmit = function() { doSearch($('path').value);return false; };
        $('s').onfocus = focusS; // Function to clear the default search box text on focus
        var s = $('searchresults');
        var f = $('searchform');
        o.id = 'old-search-results';
        n.id = 'current-search-results';
        s.appendChild(n);
        s.appendChild(o);
        o.style.display = 'none';
        n.style.display = 'none';

        is_searching = false;
    }
}
function close(){
	new Effect.BlindUp('current-search-results', {
				afterFinish: function(){
										$('searchresults').style.display = 'none';
									}
				
				});
	
}
function doSearch(path) {
    // If we're already loading, don't do anything
    if (is_searching) return false; 
    s = $F('s');
    // Same if the search is blank
    if (s == '' || s == 'Start Your Search...') return false; 
    is_searching = true;
    c = $('current-search-results');
    o = $('old-search-results');
    b = $('searchbutton');
    b.value = 'Loading';
    b.disabled = true;
    o.innerHTML = c.innerHTML;
    c.style.display = 'none';
    o.style.display = 'block';

    // Setup the parameters and make the ajax call
    pars = 's=' + escape(s) + '&ajax';

    var myAjax = new Ajax.Request(path, 
          {method: 'get', parameters: pars, onComplete:doSearchResponse});
}

function doSearchResponse(response) {
	$('searchresults').style.display = 'block';
  
    $('current-search-results').innerHTML = response.responseText;
    new Effect.BlindUp('old-search-results',{duration:.8});
    new Effect.BlindDown('current-search-results',{duration:.8, afterFinish:resetForm});
}

function resetForm() {
    s = $('searchbutton');
    s.value = 'Find It';
    s.disabled = false;
    is_searching = false;
		new Effect.Highlight('searchresults');
}

function focusS() {
    if ($F('s') == 'Start Your Search...') $('s').value = '';
}

Event.observe(window, 'load', activateSearch, false);











