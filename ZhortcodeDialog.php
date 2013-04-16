<?php 
	class ZhortcodeDialog {
		public function __construct() {}

		public function text(  $id , $label , $args = array() )
		{
			$args = wp_parse_args( $args, array(
				'label'   => $label,
				'id'      => $id,
				'default' => ''
			));

			extract($args);

			$this->html .= "<div class='zh-text-field'>";
			$this->html .= '<label for="'.$id.'">'.$label.'</label>';
			$this->html .= '<input class="zh-param" type="text" name="'.$id.'" id="'.$id.'" value="'.$default.'" />';
			$this->html .= '</div>';

			return $this;
		}

		public function number(  $id , $label , $args = array() )
		{
			$args = wp_parse_args( $args, array(
				'label'   => $label,
				'id'      => $id,
				'default' => ''
			));

			extract($args);

			$this->html .= "<div class='zh-number-field'>";
			$this->html .= '<label for="'.$id.'">'.$label.'</label>';
			$this->html .= '<input class="zh-param" type="number" name="'.$id.'" id="'.$id.'" value="'.$default.'" />';
			$this->html .= '</div>';

			return $this;
		}


		public function select($id , $label , $options = array() ) {
			$args = wp_parse_args( $args, array(
				'label'   => $label,
				'id'      => $id,
				'options' => $options
			));

			extract($args);

			$this->html .= "<div class='zh-select-field'>";
			$this->html .= '<label for="'.$id.'">' . $label . '</label>';
			$this->html .= '<select name='.$id.' id="'.$id.'">';
				foreach($options as $k => $v) {
					$this->html .= '<option value="'. $k .'">'.$v.'</option>';
				}
			$this->html .= "</select>";
			$this->html .= "</div>";

			return $this;
		}


		public function color($id, $label, $color = "") 
		{
			$args = wp_parse_args( $args, array(
				'label'   => $label,
				'id'      => $id,
				'options' => $options
			));

			extract($args);

			$this->html .= "<div class='zh-colorpicker'>";
			$this->html .= '<label for="'.$id.'">'.$label.'</label>';
			$this->html .= '<input class="zh-param" type="text" name="'.$id.'" id="'.$id.'" value="'.$color.'" />';
			$this->html .= '</div>';

			return $this;
		}

		public function upload( $id , $label )
		{
			$args = wp_parse_args( $args, array(
				'label'   => $label,
				'id'      => $id,
				'default' => ''
			));

			extract($args);

			$this->html .= "<div class='zh-upload'>";
			$this->html .= '<label for="'.$id.'">'.$label.'</label>';
			$this->html .= '<input class="zh-param" type="text" name="'.$id.'" id="'.$id.'" value="'.$default.'" />';
			$this->html .= '<a class="button-secondary" href="#">'.__('Upload', 'zhortcode').'</a>';
			$this->html .= '</div>';

			return $this;
		}
		
		
		public function column() 
		{
			$sizes = func_get_args();
			
			$this->html .= "<div class='row-fluid zh-col-select'>";
			$cols = "[row]";
			foreach($sizes as $size) 
			{
				$this->html .= '<div class="zh-col span'. $size .'">'.$size.'</div>';
				$cols .= "[span columns=".$size."] Your content [/span] \n";
			}
			
			$cols .= "[/row]";
			$this->html .= '<input type="radio" class="hidden" name="columns" value="'.$cols.'"></input>';
			$this->html .= "</div>";
			
			
			
			return $this; 
		}


		public function insert( $shortcode , $params = array(), $content = null )
		{
			if (empty($shortcode)) return;

			$hidden = "[" . $shortcode;

			if (is_array($params))
			{
				foreach($params as $name => $default)
				{
					$hidden .= ' ' . $name . '="%'.$name.'%" ';
				}
			}

			$hidden .=  "]";

			$hidden .= '%content%';
			$hidden .= '[/' . $shortcode . ']';

			$html = '
				<br />
				<label>&nbsp;</label>
				<input type="submit" class="zh-insert" value='.__('Insert', 'zhortcode').'  class="button-primary" />
				<div class="hidden zh-template">
					'.$hidden.'
				</div>
			';
			$this->html .= $html;
			return $this;
		}




		public function html() 
		{
			ob_start();
			?>
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>Zhortcodes | <?php echo Zhortcode_Version; ?></title>
				<link rel="stylesheet" href="<?php echo admin_url(); ?>css/colors-fresh.min.css">
				<link rel="stylesheet" href="<?php  echo admin_url(); ?>load-styles.php?c=1&dir=ltr&load=jquery,admin-bar,buttons,media-views,wp-admin">
				<?php wp_enqueue_script('jquery'); ?>
				<?php 
					function wpa82718_scripts() {
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
					add_action( 'wp_enqueue_scripts', 'wpa82718_scripts', 100 );
				?>
				<link rel="stylesheet" href="<?php echo Zhortcode_Uri; ?>/css/dialog.css">

				<script src="<?php echo Zhortcode_Uri; ?>js/dialog.js"></script>
			</head>
			<body>
				<div class='wrap'><?php echo $this->html; ?></div>
			</body>
			</html>
			<?php

			$html = ob_get_clean();

			
		
			return $html;
		}
	}
?>

