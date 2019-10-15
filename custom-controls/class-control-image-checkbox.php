<?php

if ( class_exists( 'WP_Customize_Control' ) ) {


	/**
	 * Image Check Box Custom Control
	 *
	 * @author  Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link    https://github.com/maddisondesigns
	 */
	class Skyrocket_Image_Checkbox_Custom_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'image_checkbox';


		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_style( 'skyrocket-control-image-checkbox-css', get_stylesheet_directory_uri() . '/includes/customizer/assets/css/control-image-checkbox.css', array(), '1.0', 'all' );
		}


		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			?>
			<div class="image_checkbox_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<?php $checkbox_value = explode( ',', esc_attr( $this->value() ) ); ?>
				<input
					type="hidden"
					id="<?php echo esc_attr( $this->id ); ?>"
					name="<?php echo esc_attr( $this->id ); ?>"
					value="<?php echo esc_attr( $this->value() ); ?>"
					class="customize-control-multi-image-checkbox" <?php $this->link(); ?> />
				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="checkbox-label"> <input
							type="checkbox"
							name="<?php echo esc_attr( $key ); ?>"
							value="<?php echo esc_attr( $key ); ?>" <?php checked( in_array( esc_attr( $key ), $checkbox_value, true ), 1 ); ?>
							class="multi-image-checkbox"/> <img
							src="<?php echo esc_attr( $value['image'] ); ?>"
							alt="<?php echo esc_attr( $value['name'] ); ?>"
							title="<?php echo esc_attr( $value['name'] ); ?>"/> </label>
				<?php } ?>
			</div>
			<?php

		}
	}
}
