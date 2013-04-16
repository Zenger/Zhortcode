<?php 
	class Space_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Space',
			'dialog' => false,
			'parent' => 'Miscellaneous',
		);

		var $defaults = array(
			'size'    => '20',
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$size = intval($size);
			
			$html = '<div style="line-height:'.$size.'px;">&nbsp;</div>';

			return $html;
		} 
		
	}
?>

