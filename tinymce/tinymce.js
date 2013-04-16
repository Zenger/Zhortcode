// closure to avoid namespace collision
;(function(){
	
	// creates the plugin
	tinymce.create('tinymce.plugins.zhortcode', {
		init: function (d, e) {
			d.addCommand("scnOpenDialog", function (a, c) {
				scnSelectedShortcodeType = c.identifier;

				tb_show('Edit Shortcode', e + '/dialog.php?sc=' + encodeURI( c.identifier ) + '&height=700' );
			});
		},
		// creates control instances based on the control's id.
		createControl : function(id, controlManager)
		{
			if(id == "zhortcode")
			{
				// creates the button
				var button = controlManager.createMenuButton('zhortcode', {
					title : 'Shortcodes Editor', // title of the button
					image : Zhortcode.uri + '/tinymce/icon.png', // path to the button's image
					icons: false
				});
				
				var self = this;
				// add all submenu of menu tinymce
				button.onRenderMenu.add(function(c , m) {
					Zhortcode.renderMenu( self , c, m );
				});
				
				return button;
			}
			return null;
		},
		addImmediate: function (d, e, a) {
			d.add({
				title: e,
				onclick: function () {
					var selection = tinyMCE.activeEditor.selection.getContent();
					var patt = /\]([\sa-zA-Z.]+)\[/g
					var content = (selection) ? a.replace(patt, "]" + selection + "[") : a;
					tinyMCE.activeEditor.execCommand("mceInsertContent", false, content);
				}
			})
		},
		addWithDialog: function (d, e, a) {
			d.add({
				title: e,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("scnOpenDialog", false, {
						title: e,
						identifier: a
					})
				}
			})
		},
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('zhortcode', tinymce.plugins.zhortcode);	
	
})();




