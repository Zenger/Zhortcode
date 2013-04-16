<?php 
	class Row_Zhortcode {
		private function __clone() {}
		public function __construct() { $this->tinymce = null; }
		
		var $defaults = array();
		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			$content = do_shortcode($content);
			
			return "<div class='row-fluid'>".$content."</div>";
		}
	}
?>