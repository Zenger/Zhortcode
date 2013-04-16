<?php 
	class Tab_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Tab',
			'dialog' => false,
			'parent' => 'Tabs',
			'pattern' => '[tab title="Tab title"] Tab content goes here [/tab]'
		);

		var $defaults = array(
			'title' => 'Title'
		); 

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);

			$html = "<div class='zh-tab-title'>{$title}</div>";
			$html .= "<div class='zh-tab-content'>{$content}</div>";

			return $html;
		} 
		
	}
?>