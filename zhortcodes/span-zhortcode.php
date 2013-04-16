<?php 
	class Span_Zhortcode {
		private function __clone() {}
		public function __construct() { $this->tinymce = null; }
		
		var $defaults = array(
			'columns' => 4
		);
		
		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			$content = do_shortcode($content);
			
			return "<div class='span".$columns."'>".$content."</div>";
		}
	}
?>