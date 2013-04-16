<?php 
	/* Compatibility class */
	 // Extend alert class to use it, in case someone uses message instead of alert 
	class Message_Zhortcode extends Alert_Zhortcode
	{
		private function __clone() {}


		/* Render as the parent would render */
		public function render($attrs, $content = null) {
			return parent::render($attrs, $content);
		}

		/* We don't need it twice in the tinymce */
		public function __construct() {
			$this->tinymce = "";
		}
		
	}
?>