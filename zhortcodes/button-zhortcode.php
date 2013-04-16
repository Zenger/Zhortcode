<?php 
	class Button_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Button',
			'dialog' => true,
		
		);

		var $defaults = array(
			'href' => '#',
			'target' => 'self',
			'rel' => '',
			'color' => '#ebebeb',
			'textcolor' => '#808080',
			'bordercolor' => '#e0e0e0'
		);

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));
			
			// @TODO
			
			$html = "<a href='{$href}' rel='{$rel}' target='_{$target}' class='zh-btn' style='background-color:{$color};border:1px solid {$bordercolor}'><span style='color:{$textcolor};opacity:1'>{$content}</span></a>";

			return $html;
		} 

		public function dialog() 
		{
			$dialog = new ZhortcodeDialog();

			$dialog->text('href', 'Link url (href) ')

				   ->select( 'target', 'Target' , 
				   			array('_blank' => 'Blank (new window)', '_self' => 'Current page (self)') 

				   	)
				   ->text ('rel' , 'rel')
				   ->color('color',       'Button color', '#ebebeb')
				   ->color('textcolor',   'Text Color', '#808080')
				   ->color('bordercolor', 'Border Color', '#e0e0e0')
				   ->insert(
				   		'button',
				   		$this->defaults,
				   		''
				   	);

			echo $dialog->html();
		}
		
	}
?>

