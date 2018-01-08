var AJAX_ROOT = 'http://localhost/job-shop/api/';
var BASE_URL = 'http://localhost/job-shop/';
var TIME_NOW = new Date();

var DATE_TODAY = new Date();
DATE_TODAY.setMinutes(DATE_TODAY.getMinutes() - DATE_TODAY.getTimezoneOffset()); 
DATE_TODAY = DATE_TODAY.toISOString().split('T')[0];

var DATE_MONTH_FIRST = new Date(TIME_NOW.getFullYear(), TIME_NOW.getMonth(), 1, 1);
DATE_MONTH_FIRST.setMinutes(DATE_MONTH_FIRST.getMinutes() - DATE_MONTH_FIRST.getTimezoneOffset());
DATE_MONTH_FIRST = DATE_MONTH_FIRST.toISOString().split('T')[0];


Vue.http.options.emulateJSON = true;


String.prototype.trunc = String.prototype.trunc || function(n){
	return (this.length > n) ? this.substr(0, n-1) + '..' : this+"";
};
Date.prototype.yearMonth = Date.prototype.yearMonth || function(n){
	var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
	return months[this.getMonth()]+ " "+ this.getFullYear();
};