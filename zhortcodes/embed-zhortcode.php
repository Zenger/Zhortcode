<?php 
	class Embed_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Embed',
			'dialog' => false,
			'parent' => 'Embed',
		);

		var $defaults = array();

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			
			
			$html = $content;

			return $html;
		} 
		
	}
?>

