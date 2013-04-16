<?php 
	class Toggle_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Toggle',
			'dialog' => false,
			'parent' => 'Accordion',
			'pattern' => '[toggle title="Your title"][/toggle]'
		);

		var $defaults = array(
			'title' => 'Your title'
		);

		var $content = "Your content here";

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);
			
			$href = "toggle-".rand();
			
			$parent = "accordion-parent-".intval( $_SESSION['accordion_count']);
			

			$html = "<div class='accordion-group zh-toggle zh-background-color zh-content-font'>";
			$html .= '<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$parent.'" href="#'.$href.'">
						'.$title.'
						</a>
					</div>
					<div id="'.$href.'" class="accordion-body collapse">
						<div class="accordion-inner">
						'.$content.'
						</div>
					</div>
					';
			$html .= "</div>";

			return $html;
		} 


	
		
	}
?>