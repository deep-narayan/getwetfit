
var dezSettingsOptions = {};

function getUrlParams(dParam) 
	{
		var dPageURL = window.location.search.substring(1),
			dURLVariables = dPageURL.split('&'),
			dParameterName,
			i;

		for (i = 0; i < dURLVariables.length; i++) {
			dParameterName = dURLVariables[i].split('=');

			if (dParameterName[0] === dParam) {
				return dParameterName[1] === undefined ? true : decodeURIComponent(dParameterName[1]);
			}
		}
	}

(function($) {
	
	"use strict"
	
	var direction =  getUrlParams('dir');
	
	dezSettingsOptions = {
		typography: "poppins",
		version: "light",
		layout: "horizontal",
		primary: "color_5",
		headerBg: "color_1",
		navheaderBg: "color_1",
		sidebarBg: "color_1",
		sidebarStyle: "full",
		sidebarPosition: "static",
		headerPosition: "fixed",
		containerLayout: "full",
		direction: direction
		};

	
	if(direction == 'rtl')
	{
        direction = 'rtl'; 
    }else{
        direction = 'ltr'; 
    }
	
	new dezSettings(dezSettingsOptions); 

	jQuery(window).on('resize',function(){
        /*Check container layout on resize */
        dezSettingsOptions.containerLayout = $('#container_layout').val();
        /*Check container layout on resize END */
        
		new dezSettings(dezSettingsOptions); 
	});
	
})(jQuery);