var xhr_nav = typeof XMLHttpRequest != 'undefined' ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
xhr_nav.open('get', 'navbar.html', true);
xhr_nav.onreadystatechange = function() {
    if (xhr_nav.readyState == 4 && xhr_nav.status == 200) { 
        document.getElementById("navbar").innerHTML = xhr_nav.responseText;
    } 
}
xhr_nav.send();

var xhr_footer = typeof XMLHttpRequest != 'undefined' ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
xhr_footer.open('get', 'footer.html', true);
xhr_footer.onreadystatechange = function() {
    if (xhr_footer.readyState == 4 && xhr_footer.status == 200) { 
        document.getElementById("footer").innerHTML = xhr_footer.responseText;
    } 
}
xhr_footer.send();