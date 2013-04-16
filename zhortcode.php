<?php 
	define('Zhortcode_Version', '1.0');

	if (!defined('Zhortcode_Uri'))  define('Zhortcode_Uri' , get_template_directory_uri() . '/zhortcode/');
	if (!defined('Zhortcode_Dir'))  define('Zhortcode_Dir' , get_template_directory()     . '/zhortcode/');

	require_once('ZhortcodeDialog.php'); // helper function for dialog shortcodes

	class Zhortcode {
		private function __clone() {}

		protected $zhortcodes = array(
			
			/* Grid System */
			'columns'    => 'columns',
			'row' 		 => 'row',
			'span' 		 => 'span',
			
			/* Accordion */
			'accordion'  => 'accordion',
			'toggle'	 => 'toggle',

			/* Misc */
			'dropcap'    => 'dropcap',
			'quote'	     => 'quote',
			'blockquote' => 'blockquote',
			'label'      => 'label',
			'badge'      => 'badge',
			'highlight'  => 'highlight',
			'progress'   => 'progress',
			'tooltip'    => 'tooltip',
			'clear'		 => 'clear',
			'space'      => 'space',

			/* Buttons */
			'button'	 => 'button',
			
			/* Alerts */
			'alert'      => 'alert',
			'message'    => 'message',

			/* Lists */
			'list'		 => 'list',

			/* Tabs */
			'tabgroup'   => 'tabgroup',
			'tab'		 => 'tab',
			
			
			/* Embed */
			'embed'      => 'embed',
			'video'      => 'video',
			'audio'      => 'audio',
			'gmap'       => 'gmap',
			'iframe'     => 'iframe',

			/* e scroll */
			'escroll'    => 'escroll',
			
			
		);

		public static function getInstance()
	    {
	        static $inst = null;
	        if ($inst === null) {
	            $inst = new Zhortcode();
	        }
	        return $inst;
	    }

	    /* Singleton protection */
	    private function __construct() {
	    	$this->run();
	    }

		public function run() 
		{
			if (is_array($this->zhortcodes))
			{
				foreach ($this->zhortcodes as $zhortcode) {
					if (is_readable( Zhortcode_Dir . 'zhortcodes/' . $zhortcode . '-zhortcode.php' ))
					{
						require_once ( Zhortcode_Dir . 'zhortcodes/' . $zhortcode . '-zhortcode.php' );

						$classname = ucfirst($zhortcode) . "_Zhortcode" ;
						$this->{$zhortcode} = new $classname();

						$this->loaded_shortcodes[] = $zhortcode;


						if (property_exists( $this->{$zhortcode} , 'tinymce') && is_array($this->{$zhortcode}->tinymce))
						{
							$this->tinymceButtons[$zhortcode] = $this->{$zhortcode}->tinymce;
							$this->tinymceButtons[$zhortcode]['defaults'] = $this->{$zhortcode}->defaults;
						}
						

						add_shortcode( $zhortcode , array( $this->{$zhortcode} , 'render' ) );
					}
				}
			}

			/* Front end */
			add_action('wp_enqueue_scripts' , array($this , 'frontend_header') );

			/* Backend */
			add_action('admin_head', array($this, 'backend_header'), 100);
			add_action('admin_head', array($this, 'generate_tinymce_js'));



			// Don't bother doing this stuff if the current user lacks permissions
			if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
			{
				// Add only in Rich Editor mode
				if ( get_user_option('rich_editing') == 'true') {
					add_filter("mce_external_plugins", array($this, "register_tinymce_plugin"));
					add_filter('mce_buttons', array($this, 'register_tinymce_button'));
				}
			}	
			
			
		}

		public function getList()
		{
			return $this->zhortcodes;
		}

		public function register_tinymce_plugin($plugins)
		{
			$plugins['zhortcode'] = Zhortcode_Uri .'tinymce/tinymce.js';
			return $plugins;
		}

		public function register_tinymce_button($buttons)
		{
			array_push($buttons, 'zhortcode');
			return $buttons;
		}

		public function frontend_header()
		{
			wp_register_style( 'zhortcode.css' , Zhortcode_Uri . 'css/zhortcode.css' ,null, Zhortcode_Version);
			wp_enqueue_style ( 'zhortcode.css' );
			
			wp_register_script('googlemap', 'http://maps.google.com/maps/api/js?sensor=false', null, '3.0');
			wp_register_script('gmap3.js', Zhortcode_Uri . 'js/gmap3.js', array('googlemap','jquery'), '5.0b');
			wp_register_script('zhortcode.js', Zhortcode_Uri . 'js/zhortcode.js', array('jquery','gmap3.js'), Zhortcode_Version);
			wp_enqueue_script('gmap3.js');
			wp_enqueue_script('zhortcode.js');
		}

		public function backend_header()
		{
			// attach items for the admin area
			wp_register_script('zhortcode.js', Zhortcode_Uri . 'tinymce/zhortcode.js', array('jquery', 'underscore'), Zhortcode_Version );
			wp_enqueue_script( 'zhortcode.js'); 

			/* Dialog colorpicker */
			wp_enqueue_style( 'wp-color-picker' );
		    wp_enqueue_script(
		        'iris',
		        admin_url( 'js/iris.min.js' ),
		        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
		        false,
		        1
		    );
		    wp_enqueue_script(
		        'wp-color-picker',
		        admin_url( 'js/color-picker.min.js' ),
		        array( 'iris' ),
		        false,
		        1
		    );  		

		}

		public function generate_tinymce_js() {
			
			?>
			<script>
				jQuery(function() {
						window.Zhortcode.uri = "<?php echo Zhortcode_Uri; ?>";
						window.Zhortcode.menuItems = <?php echo json_encode( $this->generateTinymceArray() ); ?>;
				});
			</script>
			<?php
		}

		public function generateTinymceArray() 
		{
			$tinymce = array();


			
			
			if (is_array($this->tinymceButtons))
			{
				foreach($this->tinymceButtons as $id => $button)
				{
					if ( array_key_exists('parent' , $button ) && $button['parent'] == true)
					{
						$tinymce[ $button['parent'] ]['children'][$id] = $button;
					}
					else
					{
						$tinymce[$id] = $button;
					}
				}
			}

		
			
			return $tinymce;
		}


	}

	$zhortcode = Zhortcode::getInstance();

	
?>