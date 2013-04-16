<?php 
	class Gmap_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Google Map',
			'dialog' => true,
			'parent' => 'Embed'
		);

		var $defaults = array(
			'width' => '100%',
			'height' => '150',
			'zoom' => '8',
			'latitude' => '0',
			'longitude' => '0',
			'title' => 'Contacts'
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			
			$uniqid = uniqid();
			
			// @TODO
			$html = "
				<script type='text/javascript'>
					jQuery(function() {
						jQuery('.zh-gmap-$uniqid').gmap3({
							map : {
								options : {
									center : [$latitude, $longitude],
									zoom : $zoom
								}
							},
							marker : {
								values : [{latLng : [$latitude, $longitude]}],
								options : { draggable : false },
								events : {
									click : function(marker, event) {
										var self = jQuery(this);
										var map = self.gmap3('get');
										
										self.gmap3({
											infowindow : {
												anchor : marker,
												options : {content: '$content'}
											}
										});
									}
								}
							}
						});
					});
				</script>
			";
			$html .= "<div class='zh-gmap zh-gmap-".$uniqid."' style='width:{$width}px;height:{$height}px'></div>";

			return $html;
		} 

		public function dialog() 
		{
			$dialog = new ZhortcodeDialog();

			$dialog->number('width', 'Width')
				   ->number('height', 'Height')
				   ->number('zoom', 'Value of zoom, max 16')
				   ->number('latitude', 'Latitude value')
				   ->number('longitude', 'Longitude value')
				   ->text('title', 'Title of the map')
				   ->insert(
				   		'gmap',
				   		$this->defaults,
				   		''
				   	);

			echo $dialog->html();
		}
		
	}
?>

