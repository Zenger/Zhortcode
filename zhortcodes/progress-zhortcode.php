<?php 
	class Progress_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Progress',
			'dialog' => false,
			'parent' => 'Miscellaneous',
		);

		var $defaults = array(
			'color'    => '#717171',
			'progress' => '50%'
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			
			
			$html = '<div class="progress"><div style="background:'.$color.';width:'.$progress.';" class="zh-progress bar">'.do_shortcode( $content ).'</div></div>';

			return $html;
		} 
		
	}
?>

