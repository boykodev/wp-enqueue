var scripts = document.getElementsByTagName("script");
var scriptLocation = scripts[scripts.length - 1].src;
var filename = scriptLocation.split('/').pop().split('?').shift();
console.log(filename + ' - ' + (typeof jQuery !== 'undefined'));