<?php 
	class Accordion_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Accordion',
			'dialog' => false,
			'parent' => 'Accordion',
			'pattern' => '[accordion] Toggles here [/accordion]'
		);

		var $defaults = array();

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);
			$parent = "accordion-parent-".intval( $_SESSION['accordion_count']);

			$html = "<div id='".$parent."' class='accordion zh-accordion zh-background-color'>";
			$html .= $content;
			$html .= "</div>";
			$_SESSION['accordion_count'] = intval( $_SESSION['accordion_count']) +1;
			return $html;
		} 
		
	}
?>