var Zhortcode = {
	renderMenu: function(tiny, c , m)
	{

		try {
			var mi = Zhortcode.menuItems;
			var pattern;

			/* Make use of underscore.js */
			_.each(mi, function( item , shortcode ) {


				if (item.children === undefined)
				{
					if (item.pattern == undefined) {

						pattern = "[" + shortcode + " ";
						_.each(item.defaults, function(k, i) { 
							
							pattern += " " + i + "=" + "\"" +k+"\"";
						});
						pattern += "] [/" + shortcode + "]";
					}
					else
					{
						pattern = item.pattern;
					}

					if (item.dialog == false)
					{
						tiny.addImmediate(m, item.label , pattern);
					}
					else
					{
						tiny.addWithDialog(m, item.label, shortcode )
					}
				}
				else
				{
					var parent = m.addMenu({title: shortcode });
					_.each(item.children, function( child, scname ) {

						

						if (child.dialog == false)
						{
							//var pattern = (child.pattern === undefined) ? "[%s] [/%s]".replace("%s", scname).replace("%s", scname) : child.pattern;

							if (child.pattern == undefined) {

								pattern = "[" + scname + " ";
								_.each(child.defaults, function(k, i) { 
									
									pattern += " " + i + "=" + "\"" +k+"\"";
								});
								pattern += "] [/" + scname + "]";
							}
							else
							{
								pattern = child.pattern;
							}

							

							tiny.addImmediate( parent, child.label, pattern );
						}
						else
						{
							tiny.addWithDialog(parent, child.label, scname );
						}

					});
				}



			});
		}
		catch(ex) {
		 	console.warn(ex.message);
		}

		
	},


	parseShortcode: function(sc, values) 
	{

		
		_.each(values, function(k, i) {
			
			 sc = sc.replace( '%' + k.name + "%" , k.value );
			
		});
		
		return sc;
	},

	insertShortcode : function (shortcode) 
	{
		tinyMCE.activeEditor.execCommand("mceInsertContent", false, shortcode);
		tb_remove();
	}
}