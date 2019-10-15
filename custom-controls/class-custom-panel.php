<?php
if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Panel Custom
	 *
	 *
	 * @license http://www.gnu.org/licenses/gpl-3.0.html
	 * @link    https://gist.github.com/rodica-andronache/8a84147b4151bccd99c61ad020e295b8
	 * @example $wp_customize->register_panel_type( 'PE_WP_Customize_Panel' );
	 * @example $wp_customize->register_section_type( 'PE_WP_Customize_Section' );
	 *
	 */
	class PE_WP_Customize_Panel extends WP_Customize_Panel {

		public $panel;

		public $type = 'pe_panel';


		/**
		 * Scripts for this control
		 */
		public function enqueue() {

			/*wp_enqueue_style( 'slider-controls-css', get_stylesheet_directory_uri() . '/includes/customizer/assets/css/customizer-control.css', null );*/

			wp_enqueue_script(
				'customizer-panel-js',
				get_stylesheet_directory_uri() . '/includes/customizer/assets/js/customizer-panel.js',
				array(
					'jquery',
					'jquery-ui-sortable',
				),
				'1.1',
				true
			);

		}


		public function json() {

			$array = wp_array_slice_assoc(
				(array) $this,
				array(
					'id',
					'description',
					'priority',
					'type',
					'panel',
				)
			);

			$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content']        = $this->get_content();
			$array['active']         = $this->active();
			$array['instanceNumber'] = $this->instance_number;

			return $array;
		}
	}
}
