var pathname = window.location.pathname;
var filename = pathname.substring(pathname.lastIndexOf('/') + 1);
var arr = filename.split('.');            

const out = document.querySelector('.breadcrumb');
out.innerHTML += " / " + arr[0];