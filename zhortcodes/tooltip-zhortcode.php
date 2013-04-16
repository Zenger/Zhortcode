<?php 
	class Tooltip_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'parent' => 'Miscellaneous',
			'label'  => 'Tooltip',
			'dialog' => false,
		
		);

		var $defaults = array(
			'placement' => 'top',
			'title' => 'Your title',
			'href' => '#',
		);

		var $content = "Your content here";

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			
			// @TODO
			
			if ( !in_array( strtolower($type), array('top', 'bottom', 'left', 'right')) ) $placement = "top";
			
			$html = '<a href="'.$href.'" class="zh-tooltip" data-toggle="tooltip" data-placement="'.$placement.'"  title="'.$title.'">'.$content.'</a>';

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

