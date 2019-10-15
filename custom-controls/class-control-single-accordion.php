<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Single Accordion Custom Control
	 *
	 * @author  Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link    https://github.com/maddisondesigns
	 */
	class Skyrocket_Single_Accordion_Custom_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'single_accordion';


		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_script(
				'skyrocket-control-single-accordion-js',
				get_stylesheet_directory_uri() . '/includes/customizer/assets/js/control-single-accordion.js',
				array( 'jquery' ),
				'1.0',
				true
			);
			wp_enqueue_style( 'skyrocket-control-single-accordion-css', get_stylesheet_directory_uri() . '/includes/customizer/assets/css/control-single-accordion.css', array(), '1.0', 'all' );
			//wp_enqueue_style( 'fontawesome', trailingslashit( get_stylesheet_directory_uri() ) . 'css/font-awesome.min.css', array(), '4.6.3', 'all' );
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
			);
			?>
			<div class="single-accordion-custom-control">
				<div class="single-accordion-toggle"><?php echo esc_html( $this->label ); ?><span class="accordion-icon-toggle dashicons dashicons-plus"></span></div>
				<div class="single-accordion customize-control-description">
					<?php

					if ( is_array( $this->description ) ) {
						echo '<ul class="single-accordion-description">';
						foreach ( $this->description as $key => $value ) {
							echo '<li>' . $key . wp_kses( $value, $allowed_html ) . '</li>';// WPCS: XSS ok.
						}
						echo '</ul>';
					} else {
						echo wp_kses( $this->description, $allowed_html );
					}
					?>
				</div>
			</div>
			<?php

		}
	}
}