<?php 
	class Columns_Zhortcode  
	{
		private function __clone() {}

		var $tinymce = array(
			'label'  => 'Columns',
			'dialog' => true,
		
		);

		var $defaults = array(); 

		var $content;

		public function render($atts = null, $content = null)
		{
			
			extract(shortcode_atts($this->defaults, $atts));

			
			return "";
		} 
		
		public function dialog()
		{
			$dialog = new ZhortcodeDialog();
		
			$dialog ->column( 2, 10)
					->column( 3, 9 )
					->column( 4, 8 )
					->column( 5, 7 )
					->column( 6, 6 )
					->column( 7, 5 )
					->column( 8, 4 )
					->column( 9, 3 )
					->column( 10, 2 )
					->column( 4 , 4, 4 )
					->column( 3 , 3, 3 , 3)
					->column( 2, 2, 2, 2, 2, 2 )
					->column( 6, 3, 3)
					->column( 3, 6, 3)
					->column( 3, 4, 5)
					->column( 5, 4, 3)
			
			
			->insert( 
				   		'columns',
				   		$this->defaults,
				   		$this->content
					);

			

			
			echo $dialog->html();
		}
		
	}
?>