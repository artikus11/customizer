<?php
if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Simple Title Custom Control
	 *
	 * @author ArtAbr
	 */
	class Art_Final_Line_Section_Custom_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'final_line';


		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			?>
			<hr class="customize-control-final-line">
			<?php

		}
	}
}
