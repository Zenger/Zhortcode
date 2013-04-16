<?php 
	
	class Iframe_Zhortcode
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Iframe',
			'dialog' => true,
			'parent' => 'Embed',
			'pattern' => ''
		);

		var $defaults = array(
				'width'  => '100%',
				'height' => '100%',
				'src'    => 'src'
		);

		var $content = "";


		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);

			
			$html  = '<div class="zh-iframe-container zh-background-color">';
				$html .= '<iframe src="'.$src.'" height="'.$height.'" width="'.$width.'" frameborder="0" allowtransparency="true" ></iframe>';
			$html .= '</div>';
					 
			return $html;
		} 


		public function dialog($post = null) 
		{
						
			$dialog = new ZhortcodeDialog();

			$dialog->number('width', 'Width (% or px)')
				   ->number('height', 'Height (% or px)')
				   ->text('src', 'Link')
				   ->insert( 
				   		'iframe',
				   		$this->defaults,
				   		$this->content
					);

			

			
			echo $dialog->html();
		}



		
	}
?>