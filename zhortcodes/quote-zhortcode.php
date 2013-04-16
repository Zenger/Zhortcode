<?php 
	class Quote_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Quote',
			'dialog' => false,
			'parent' => 'Miscellaneous',
			#'pattern' => '[quote type="a" author="Author"] Toggles here [/quote]'
		);

		var $defaults = array(
			'type'   => 'a', // a, b, c
			'author' => ''
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);

			$html = "<div class='zh-quote zh-content-font zh-quote-".$type."'>";
			$html .= $content;
			$html .= "<p class='zh-quote-author'>". $author ."</p>";
			$html .= "</div>";

			return $html;
		}
		
	}
?>