<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Class Art_Images_Slider_Custom_Control
	 *
	 * @since 1.0.0
	 * @since 1.1.0
	 */
	class Art_Images_Slider_Custom_Control extends WP_Customize_Control {

		public $type = 'slider_images';


		/**
		 * Scripts for this control
		 */
		public function enqueue() {

			wp_enqueue_style(
				'control-image-slider-css',
				__DIR__ . '/../assets/css/control-image-slider.css',
				array(),
				1.1,
				'all'
			);

			wp_enqueue_script(
				'control-image-slider-js',
				__DIR__ . '/../assets/js/control-image-slider.js',
				array(
					'jquery',
					'jquery-ui-sortable',
				),
				1.1,
				true
			);

			wp_enqueue_media();

		}


		/**
		 * HTML
		 */
		public function render_content() {

			if ( ! empty( $this->label ) ) :

				?>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
			<?php

			endif;
			if ( ! empty( $this->description ) ) :

				?>

				<span class="description customize-control-description">
					<?php echo esc_textarea( $this->description ); ?>
				</span>
			<?php

			endif;

			$items = $this->value();

			if ( ! is_array( $this->value() ) ) {
				$items = json_decode( $this->value() );
			}

			if ( empty( $items ) ) {
				$items = array(
					array(
						'title' => '',
						'url'   => '',
						'link'  => '',
						'text'  => '',
					),
				);
			}

			echo '<ul class="repeatable">';

			foreach ( $items as $pos => $block ) {
				$title_control = $block->title;

				?>
				<li class="repeat_block ui-state-default toggled">
				<div class="repeat_title">
					<?php

					if ( empty( $title_control ) ) {
						echo 'Слайд';
					} else {
						echo esc_html( $title_control );
					}
					?>
				</div>
				<div class="remove_block">
					<div class="repeat_svg repeat_svg_delete">
						<div class="tooltiptext">Удалить</div>
					</div>
				</div>
				<div class="toggle_block">
					<div class="repeat_svg repeat_svg_down">
						<div class="tooltiptext">Свернуть</div>
					</div>
				</div>
				<?php

				foreach ( $block as $key => $value ) {
					$label = 'Заголовок';
					switch ( $key ) {
						case 'title':
							?>
							<div class="repeat-item-col">
								<label>
									<?php echo esc_attr( $label ); ?>
									<input
										data-name="<?php echo esc_attr( $key ); ?>"
										data-pos="<?php echo esc_attr( $pos ); ?>"
										type="text"
										value="<?php echo esc_attr( $value ); ?>">
								</label>
							</div>
							<?php

							break;
						case 'url':
							$img_prev = ( $value ) ? '<img src="' . $value . '" alt="slide image">' : '';

							$label = 'Изображение';
							?>
							<div class="repeat-item-col">
								<label>
									<?php echo esc_html( $label ); ?>
									<div class='img_prev'>
										<?php echo wp_kses_post( $img_prev ); ?>
									</div>
									<input
										data-name="<?php echo esc_attr( $key ); ?>"
										data-pos="<?php echo esc_attr( $pos ); ?>"
										type="hidden"
										value="<?php echo esc_attr( $value ); ?>">
									<input
										type='button'
										class='button slider_upload_image'
										value='Загрузить изображение'/>
								</label>
							</div>
							<?php

							break;
						case 'link':
							$label = 'Ссылка';
							?>
							<div class="repeat-item-col">
								<label>
									<?php echo esc_html( $label ); ?>
									<input
										data-name="<?php echo esc_attr( $key ); ?>"
										data-pos="<?php echo esc_attr( $pos ); ?>"
										type="text"
										value="<?php echo esc_attr( $value ); ?>">
								</label>
							</div>
							<?php

							break;
						case 'text':
							$label = 'Описание';
							?>
							<div class='repeat-item-col textarea-desc'>
								<label>
									<?php echo esc_html( $label ); ?>
									<textarea
										data-name="<?php echo esc_attr( $key ); ?>"
										data-pos="<?php echo esc_attr( $pos ); ?>"
										rows="3"><?php echo esc_textarea( $value ); ?></textarea>
								</label>
							</div>
							<?php

							break;
					}
				}

				echo '</li>';

			}
			echo '</ul>';
			?>
			<p>
				<a class='button button-primary repeat_block_add'>Добавить слайд</a>
			</p>
			<input
				type="hidden" <?php $this->link(); ?>
				value="<?php echo esc_attr( $this->value() ); ?>"
				class="repeatable_value"/>
			<?php

		}
	}
}