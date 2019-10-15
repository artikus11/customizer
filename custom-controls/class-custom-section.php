<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Section Custom
	 *
	 *
	 * @license http://www.gnu.org/licenses/gpl-3.0.html
	 * @link    https://gist.github.com/rodica-andronache/8a84147b4151bccd99c61ad020e295b8
	 * @example $wp_customize->register_section_type( 'PE_WP_Customize_Section' );
	 *
	 */
	class PE_WP_Customize_Section extends WP_Customize_Section {

		public $section;

		public $type = 'pe_section';


		/**
		 * Scripts for this control
		 */
		public function enqueue() {

			/*			wp_enqueue_style( 'slider-controls-css', __DIR__ . '/../assets/css/customizer-control.css', null );*/

			wp_enqueue_script(
				'customizer-section-js',
				__DIR__ . '/../assets/js/customizer-panel.js',
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
					'panel',
					'type',
					'description_hidden',
					'section',
				)
			);

			$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content']        = $this->get_content();
			$array['active']         = $this->active();
			$array['instanceNumber'] = $this->instance_number;
			if ( $this->panel ) {
				$array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
			} else {
				$array['customizeAction'] = 'Customizing';
			}

			return $array;
		}
	}
}