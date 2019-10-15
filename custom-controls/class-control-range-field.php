<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Slider Custom Control
	 *
	 * @author  Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link    https://github.com/maddisondesigns
	 */
	class Skyrocket_Range_Custom_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';


		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_script(
				'skyrocket-control-slider-field-js',
				CUSTOMIZER_DIR_ASSETS  . '/assets/js/control-slider-field.js',
				array(
					'jquery',
					'jquery-ui-core',
				),
				'1.0',
				true
			);
			wp_enqueue_style( 'skyrocket-control-slider-field-css', CUSTOMIZER_DIR_ASSETS  . '/assets/css/control-slider-field.css', array(), '1.0', 'all' );
		}


		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			$allowed_html = array(
				'a'      => array(
					'href'   => array(),
					'title'  => array(),
					'class'  => array(),
					'target' => array(),
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'i'      => array(
					'class' => array(),
				),
				'span'   => array(
					'class' => array(),
				),
				'code'   => array(),
			);
			?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input
					type="number"
					id="<?php echo esc_attr( $this->id ); ?>"
					name="<?php echo esc_attr( $this->id ); ?>"
					value="<?php echo esc_attr( $this->value() ); ?>"
					class="customize-control-slider-value" <?php $this->link(); ?> />
				<div
					class="slider"
					slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>"
					slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>"
					slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div>
				<span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>

			</div>
			<?php

			if ( ! empty( $this->description ) ) {
				?>
				<span class="customize-control-description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>
				<?php

			}
		}
	}
}
