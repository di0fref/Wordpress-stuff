function changeFontSize(inc)
{
  var p = document.getElementsByTagName('p');
  for(n=0; n<p.length; n++) {
    if(p[n].style.fontSize) {
       var size = parseInt(p[n].style.fontSize.replace("px", ""));
    } else {
       var size = 12;
    }
    p[n].style.fontSize = size+inc + 'px';
   }
}
