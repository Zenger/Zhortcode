<?php 
	/* Compatibility class */
	/* Extend the quote class to use it, in case someone uses blockquote instead of quote */
	class Blockquote_Zhortcode extends Quote_Zhortcode
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