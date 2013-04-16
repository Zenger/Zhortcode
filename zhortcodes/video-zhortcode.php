<?php 
	
	class Video_Zhortcode
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Video',
			'dialog' => true,
			'parent' => 'Embed',
			'pattern' => ''
		);

		var $defaults = array(
				'width'  => '100%',
				'height' => '100%',
				'mp4'    => '',
				'ogg'    => ''
		);

		var $content = "";


		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);

			
			$html  = '<div class="zh-video-container zh-background-color">';
			$html .= '<video class="zh-video" width="'.$width.'" height="'.$height.'" controls>';
				if ($mp4) {
					$html .= '<source src="'.$mp4.'" type="video/mp4">';
				}

				if ($ogg)
				{
					$html .= '<source src="'.$ogg.'" type="video/ogg">';
				}
					 
			$html .= __('Your browser does not support the video tag', 'zhortcode');

			$html .= '
				</video>
			</div>';

			
		

			return $html;
		} 


		public function dialog($post = null) 
		{
						
			$dialog = new ZhortcodeDialog();

			$dialog->number('width', 'Width (% or px)')
				   ->number('height', 'Height (% or px)')
				   ->upload( 'mp4', 'Mp4 Source file' )
				   ->upload( 'ogg', 'OGG Source file' )
				   ->insert( 
				   		'video',
				   		$this->defaults,
				   		$this->content
					);

			

			
			echo $dialog->html();
		}


		public function getShortcode() {
			return "video";
		}

		public function getName()
		{
			return "Video";
		}

		
	}
?>