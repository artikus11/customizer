<?php

if ( class_exists( 'WP_Customize_Control' ) ) {


	/**
	 * Simple Title Custom Control
	 *
	 * @author ArtAbr
	 */
	class Art_Title_Section_Custom_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'simple_title';


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
			<div class="simple-title-custom-control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<h2 class="customize-control-title-header"><?php echo esc_html( $this->label ); ?></h2>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-title-description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>
				<?php } ?>
			</div>
			<?php

		}
	}
}