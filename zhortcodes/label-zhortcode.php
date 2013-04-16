<?php 
	class Label_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Label', //success, warning, important, info, inverse
			'dialog' => false,
			'parent' => 'Miscellaneous',
		);

		var $defaults = array(
			'type' => 'info'
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));


			$html = '<span class="label label-'.$type.'">'.do_shortcode( $content ).'</span>';

			return $html;
		} 
		
	}
?>

