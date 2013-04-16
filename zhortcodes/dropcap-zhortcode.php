<?php 
	class Dropcap_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'parent'  => "Miscellaneous",
			'label'   => 'Dropcap',
			'dialog'  => false,
			'pattern' => '[dropcap] Your content [/dropcap]'
		);
		public function render($atts = null, $content = null)
		{
			
			$defaults = array();
			extract(shortcode_atts($defaults, $atts));

			$content = do_shortcode($content);

			$html = "<div class='zh-dropcap zh-first-letter-color zh-font'>";
			$html .= $content;
			$html .= "</div>";

			return $html;
		} 
		
	}
?>