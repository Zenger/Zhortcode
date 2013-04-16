<?php 
	
	class Audio_Zhortcode
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Audio',
			'dialog' => true,
			'parent' => 'Embed',
			'pattern' => ''
		);

		var $defaults = array(
				'mp3'    => '',
				'ogg'    => ''
		);

		var $content = "";


		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			$content = do_shortcode($content);

			
			$html  = '<div class="zh-audio-container zh-background-color">';
				$html .='<audio class="zh-audio" controls>';

				if ($ogg) {
					$html .= '<source src="'.$ogg.'" type="audio/ogg">';
				}

				if ($mp3)
				{
					$html .= '<source src="'.$mp3.'" type="audio/mpeg">';
				}
				$html .= __('Your browser does not support the audio tag', 'zhortcode');
				$html .= '</audio>';
			$html .= '</div>';
					 
			return $html;
		} 


		public function dialog($post = null) 
		{
						
			$dialog = new ZhortcodeDialog();

			$dialog->upload( 'mp3', 'Mp3 Source file' )
				   ->upload( 'ogg', 'OGG Source file' )
				   ->insert( 
				   		'audio',
				   		$this->defaults,
				   		$this->content
					);

			

			
			echo $dialog->html();
		}


		public function getShortcode() {
			return "audio";
		}

		public function getName()
		{
			return "Audio";
		}

		
	}
?>