<?php

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * TinyMCE Custom Control
	 *
	 * @since   Ephemeris 1.0
	 *
	 * @author  Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link    https://github.com/maddisondesigns
	 */
	class Skyrocket_TinyMCE_Custom_control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'tinymce_editor';


		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_script(
				'skyrocket-control-tinymce-js',
				__DIR__ . '/../assets/js/control-tinymce.js',
				array( 'jquery' ),
				'1.0',
				true
			);
			wp_enqueue_style( 'skyrocket-control-tinymce-css', __DIR__ . '/../assets/css/control-tinymce.css', array(), '1.0', 'all' );
			wp_enqueue_editor();
		}


		/**
		 * Pass our TinyMCE toolbar string to JavaScript
		 */
		public function to_json() {

			parent::to_json();
			$this->json['skyrockettinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) :
				'bold italic bullist numlist alignleft aligncenter alignright link';
			$this->json['skyrockettinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';
		}


		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			?>
			<div class="tinymce-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<textarea
					id="<?php echo esc_attr( $this->id ); ?>"
					class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</div>
			<?php

		}
	}
}