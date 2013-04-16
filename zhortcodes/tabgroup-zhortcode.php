<?php 
	class Tabgroup_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Tabgroup',
			'dialog' => false,
			'parent' => 'Tabs',
			'pattern' => '[tabgroup] Tabs go inside [/tabgroup]'
		);

		var $defaults = array();

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);

			$html = "<div class='zh-tabgroup zh-background-color'>";
			$html .= $content;
			$html .= "</div>";

			return $html;
		} 
		
	}
?>