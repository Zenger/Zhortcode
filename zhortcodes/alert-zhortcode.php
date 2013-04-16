<?php 
	class Alert_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Alert',
			'dialog' => true,
		
		);

		var $defaults = array(
			'type' => 'error'
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			
			// @TODO
			
			if ( !in_array($type, array('success', 'warning', 'error', 'info')) ) $type = "success";

			$html .= '<div class="alert alert-'.$type.'">';
			$html .= $content;
			$html .= '</div>';

			return $html;
		} 

		public function dialog() 
		{
			$dialog = new ZhortcodeDialog();

			$dialog->select( 'type', 'Alert Type' , 
				   			array('warning' => 'Warning', 'error' => 'Error', 'success' => 'Success', 'info' => 'Info') 

				   )
				   ->insert(
				   		'alert',
				   		$this->defaults,
				   		'Your content hello world'
				   	);

			echo $dialog->html();
		}
		
	}
?>

