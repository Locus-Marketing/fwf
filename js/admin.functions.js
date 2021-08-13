jQuery(document).ready(function($){

// Enable ACE editor
	var aceAreaArray = {
		ace_fwf_theme_css: 'fwf_theme_settings-misc_custom_css',
		};
	
	var editors = [];
	var $textarea = [];
	for ( var key in aceAreaArray ) {
		if ( $('#' + key).length > 0 ) {
			editors[key] = ace.edit(key);
			
			if ( key == 'ace_fwf_theme_css' ) {
				editors[key].setTheme('ace/theme/chrome');
				editors[key].getSession().setMode('ace/mode/css');
			}
			$textarea[key] = $('#'+aceAreaArray[key]).hide();
			editors[key].getSession().setValue($textarea[key].val());
			
			editors[key].getSession().setUseWrapMode(true);
			editors[key].getSession().setWrapLimitRange(null, null);
			editors[key].renderer.setShowPrintMargin(null);
			editors[key].session.setUseSoftTabs(null);
		}
	}
	
	if ( $('#ace_fwf_theme_css').length ) {
		editors['ace_fwf_theme_css'].getSession().on('change', function () { $textarea['ace_fwf_theme_css'].val(editors['ace_fwf_theme_css'].getSession().getValue()); });
	}
});