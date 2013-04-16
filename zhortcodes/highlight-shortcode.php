<?php 
	class Highlight_Zhortcode extends Label_Zhortcode
	{
		private function __clone() {}
		
		public function __construct() {
			$this->tinymce = null;
		};

		var $tinymce = null;

		var $defaults = null;

		var $content;

		public function render($atts = null, $content = null)
		{
			parent::render($atts, $content);
			
		} 
		
	}
?>

