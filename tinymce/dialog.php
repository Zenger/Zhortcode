<?php 
	$wp_path = explode('wp-content', __FILE__);
	if (is_readable( $wp_path[0] . '/wp-blog-header.php' ))
	{
		@require_once ( $wp_path[0] . '/wp-blog-header.php');
		status_header( 200 );

		$zhortcode = Zhortcode::getInstance();

		$request = filter_var( $_GET['sc'],  FILTER_SANITIZE_SPECIAL_CHARS);

		if (array_key_exists( $request, $zhortcode->getList() ) )
		{
			try {
				$class = $zhortcode->{$request};
				if (is_null($class)) {
					throw new Exception("No dialog method or zhortcode not implemented!");
				}
				else
				{
					if ( method_exists($class, 'dialog'))
					{
						$class->dialog();
					}
					else
					{
						throw new Exception("Zhortcode set as dialog but no dialog method found!");
					}
					
				}
			}
			catch( Exception $e ){
				

				wp_die( $e->getMessage() , 'Error' , array('response' => 200 ) ) ;
				
			}
		}
		else
		{
			echo "<p>" . __("The shortcode doesn't exist", 'zhortcode') . "</p>";
		}

		?>	
		


		<?php
	}
?>