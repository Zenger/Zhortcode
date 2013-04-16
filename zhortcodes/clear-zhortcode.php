<?php 
	class Clear_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Clear',
			'dialog' => false,
			'parent' => 'Miscellaneous',
		);

		var $defaults = array();

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			
			
			$html = '<div class="clear">&nbsp;</div>';

			return $html;
		} 
		
	}
?>

