/*---------------------------------------------------------------------
    File Name: custom.js
---------------------------------------------------------------------*/

$(function () {

	"use strict";

	/* Preloader
	-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */

	setTimeout(function () {
		$('.loader_bg').fadeToggle();
	}, 1500);
	
	var path = window.location.href;
	// var pathname = window.location.pathname;
    // Account for home page with empty path
    if (path == '' ) {
      path = path;
    }
	
    var target = $('nav > ul > li a[href="'+path+'"]');
    var targetValue = $('nav > ul > li a:first').attr('href');
	// Add active class to target link
	// console.log(targetValue);
	
	// var domlog = function($obj){
	// 	console.log.apply(console,$obj);
	// };
	// domlog(target);

	if (path != targetValue) {
		var remveNav = $('nav > ul li:first');
		remveNav.removeClass();
	}
	
	target.parent().addClass('active');

});
	
/* //  togglePopup ( ); // Hide them to start. */
function togglePopup ( ) {
    // let disabler = document.getElementById('disabler');
    // disabler.style.display = disabler.style.display ? '' : 'none';

    // let popup = document.getElementById('popupEnd');
    // popup.style.display = popup.style.display ? '' : 'none';

    var disabler = document.getElementById('disabler');
        if (disabler.style.display) {
        disabler.style.display = '';
        } else {
        disabler.style.display = 'none';
        }

    var popup = document.getElementById('popupEnd');
        if (popup.style.display) {
        popup.style.display = '';
        } else {
        popup.style.display = 'none';
        }

        $('#province').attr('id', 'provincecode');
        $('#district').attr('id', 'districtcode');
        $('#sector').attr('id', 'sectorcode');
        $('#cell').attr('id', 'codecell');
}
	
	


