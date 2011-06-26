// Get an XMLHttpRequest object
function GetHttpRequest() {
  if (window.XMLHttpRequest) {
    return new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    return new ActiveXObject('Microsoft.XMLHTTP');
  } else {
    return null;
  }
}

function popandchange(rawurl) {
  var hr = GetHttpRequest();
  var payload;
  var themeselect = document.getElementById('themelinks'); 
  var themeid = themeselect.options[themeselect.selectedIndex].value;
  
  var url = rawurl + "?id=" + themeid + "&action=getstyle";
  
  if (hr) {
    hr.open("GET", url, false);
    hr.send(payload);
    fillList(hr);
  }
}

function fillList(xmlreply)
{

  if (xmlreply.status == 200) // 200 = Status, OK
  {
    var response = xmlreply.responseText;
    var items = response.split("§");
    var list = document.getElementById('stylelinks');
    var x = 0;
    items.length--;
    list.length = 0;
    for (o=0; o < items.length; o++)
    {
      var parts = items[o].split("|");
      list.length = x+1;
      list[x].text = parts[0];
      list[x].value = parts[1];
      x++
    }
    parent.main.location=list.options[0].value
  }
  else
  {
    alert("Cannot handle the AJAX call." + xmlreply.status);
  }
}


