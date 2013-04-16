jQuery(function() {




	jQuery('.zh-upload a').on('click', function(e) {
		e.preventDefault();

		var item = jQuery(this).prev('input');

		var title = jQuery(this).prev().prev();

		var file_frame;
		 // If the media frame already exists, reopen it.
	   		if ( file_frame ) {
		      file_frame.open();
		      return;
		    }

		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: title.text(),
		      button: {
		        text: "Use this image",
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });

		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		      
		      item.val( attachment.url );
		      // Do something with attachment.id and/or attachment.url here
		    });

		    // Finally, open the modal
		    file_frame.open();

	});



	jQuery('.zh-insert').on('click', function(e) {

		var values = [];

		var shortcode = jQuery(this).next('.zh-template').html();

		jQuery('#TB_ajaxContent .wrap input:not([type=submit]), #TB_ajaxContent .wrap textarea').each(function(e,i) {
			values.push( { "name": jQuery(this).attr('name'), "value": jQuery(this).val() } );
		});

		jQuery('#TB_ajaxContent .wrap select').each(function() {

			var value = jQuery('option:selected', jQuery(this) ).val();
			values.push( {"name" : jQuery(this).attr('name'), "value": value} );
		});


		values.push( {"name": "content", "value" : tinyMCE.activeEditor.selection.getContent() } );
		
		sc = Zhortcode.parseShortcode(shortcode, values);
		Zhortcode.insertShortcode( sc );

	});


	jQuery(".zh-colorpicker input").each(function() {
		var color = jQuery(this).val();
	
		jQuery( this ).wpColorPicker({color:color});


	});
	
	jQuery('.zh-col-select .zh-col').on('click', function() {
		jQuery('.zh-col-select').removeClass('active');
		jQuery(this).parent().addClass('active');
		
		jQuery('.zh-template').html( jQuery('input', jQuery(this).parent() ).val() );
		
	});


});