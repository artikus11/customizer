<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Sortable Repeater Custom Control
	 *
	 * @author  Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link    https://github.com/maddisondesigns
	 */
	class Skyrocket_Sortable_Repeater_Custom_Control extends WP_Customize_Control {

		/**
		 * The type of control being rendered
		 */
		public $type = 'sortable_repeater';

		/**
		 * Button labels
		 */
		public $button_labels = array();


		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {

			parent::__construct( $manager, $id, $args );
			// Merge the passed button labels with our default labels
			$this->button_labels = wp_parse_args(
				$this->button_labels,
				array(
					'add' => 'Добавить',
				)
			);

		}


		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_script(
				'skyrocket-control-sortable-repeater-js',
				CUSTOMIZER_DIR_ASSETS . '/assets/js/control-sortable-repeater.js',
				array(
					'jquery',
					'jquery-ui-core',
				),
				'1.0',
				true
			);
			wp_enqueue_style( 'skyrocket-control-sortable-repeater-css', CUSTOMIZER_DIR_ASSETS . '/assets/css/control-sortable-repeater.css', array(), '1.0', 'all' );
		}


		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			?>
			<div class="sortable_repeater_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input
					type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>"
					class="customize-control-sortable-repeater" <?php $this->link(); ?> />
				<div class="sortable">
					<div class="repeater">
						<input type="text" value="" class="repeater-input" placeholder="https://"/><span class="dashicons dashicons-sort"></span><a
							class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
					</div>
				</div>
				<button class="button customize-control-sortable-repeater-add" type="button"><?php echo $this->button_labels['add']; ?></button>
			</div>
			<?php

		}
	}
}