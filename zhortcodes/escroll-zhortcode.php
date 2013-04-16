<?php 
	class Escroll_Zhortcode  
	{
		private function __clone() {}
		
		public function __construct() {
			$this->tinymce = null;
		}

		var $tinymce = "";

		var $defaults = array(
			
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);

			$html = "<div class='zh-accordion zh-background-color'>";
			$html .= $content;
			$html .= "</div>";

			return $html;
		} 
		
	}
?>