<?php
/**
 * Add controls.
 */
require __DIR__ . '/custom-control.php';


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function customize_preview_js() {

	wp_enqueue_script(
		'current-customizer-preview',
		get_stylesheet_directory_uri() . '/includes/customizer/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		'1.1.0',
		true
	);

}

add_action( 'customize_preview_init', 'customize_preview_js' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function customize_register_options( $wp_customize ) {

	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->get_setting( 'blogname' )->transport                      = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport               = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport              = 'postMessage';
	$wp_customize->get_control( 'custom_logo' )->section                     = 'header_theme';
	$wp_customize->selective_refresh->get_partial( 'custom_logo' )->selector = '.logo-container';

	/**
	 * Add section Theme Customizer.
	 */
/*	$wp_customize->add_section(
		'header_theme',
		array(
			'title'       => 'Шапка',
			'description' => '',
			'priority'    => 20,
		)
	);
	$wp_customize->add_section(
		'feedback_box',
		array(
			'title'       => 'Форма заявки',
			'description' => '',
			'priority'    => 25,
		)
	);
	$wp_customize->add_section(
		'footer_theme',
		array(
			'title'       => 'Подвал',
			'description' => '',
			'priority'    => 30,
		)
	);
	$wp_customize->add_section(
		'social_profile',
		array(
			'title'    => 'Профили на соцсети',
			'priority' => 35,
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'smd_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'smd_customize_partial_blogdescription',
			)
		);
	}

	$transport = ( $wp_customize->selective_refresh ? 'postMessage' : 'refresh' );*/

	/**
	 * Add header custom control Theme Customizer.
	 */
/*	$wp_customize->add_setting(
		'header_title',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		new Art_Title_Section_Custom_Control(
			$wp_customize,
			'header_title',
			array(
				'label'       => 'Настройки шапки сайта',
				'description' => 'В данной секции можно управлять выводом данных в шапке',
				'section'     => 'header_theme',
				'priority'    => 5,
			)
		)
	);
	$wp_customize->add_setting(
		'header_banner',
		array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => $transport,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'header_banner',
			array(
				'label'       => 'Банер в шапке',
				'description' => 'Укажите изображение, которое будет выводиться между логотипом и контактами',
				'width'       => 380,
				'height'      => 100,
				'section'     => 'header_theme',
				'priority'    => 10,
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'header_banner_partial',
		array(
			'selector'            => '.header-banner',
			'settings'            => 'header_banner',
			'container_inclusive' => false,
			'render_callback'     => function () {
				return smd_image( 'header_banner' );
			},
		)
	);

	$wp_customize->add_setting(
		'header_banner_line',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'header_banner_line',
			array(
				'section'  => 'header_theme',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'header_phone_one',
		array(
			'default'           => '+7 (499) 755-76-73',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_phone_one',
		array(
			'label'       => 'Телефон раз',
			'description' => 'Укажите первый номер телефона',
			'type'        => 'text',
			'section'     => 'header_theme',
			'priority'    => 15,
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'header_phone_one',
		array(
			'selector'            => '.phone.one',
			'settings'            => 'header_phone_one',
			'container_inclusive' => false,
			'render_callback'     => function () {
				return smd_text( 'header_phone_one' );
			},
		)
	);

	$wp_customize->add_setting(
		'header_phone_one_desc',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_phone_one_desc',
		array(
			'label'       => 'Подпись Телефон раз',
			'description' => 'Укажите подпись для телефона',
			'type'        => 'text',
			'section'     => 'header_theme',
			'priority'    => 15,
		)
	);

	$wp_customize->add_setting(
		'header_phone_line_one',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'header_phone_line_one',
			array(
				'section'  => 'header_theme',
				'priority' => 15,
			)
		)
	);

	$wp_customize->add_setting(
		'header_phone_two',
		array(
			'default'           => '+7 (812) 962-06-65',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_phone_two',
		array(
			'label'       => 'Телефон два',
			'description' => 'Укажите второй номер телефона',
			'type'        => 'text',
			'section'     => 'header_theme',
			'priority'    => 15,
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'header_phone_two',
		array(
			'selector'            => '.phone.two',
			'settings'            => 'header_phone_two',
			'container_inclusive' => false,
			'render_callback'     => function () {
				return smd_text( 'header_phone_two' );
			},
		)
	);

	$wp_customize->add_setting(
		'header_phone_two_desc',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_phone_two_desc',
		array(
			'label'       => 'Подпись Телефон два',
			'description' => 'Укажите подпись для телефона',
			'type'        => 'text',
			'section'     => 'header_theme',
			'priority'    => 15,
		)
	);

	$wp_customize->add_setting(
		'header_phone_line_tree',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'header_phone_line_tree',
			array(
				'section'  => 'header_theme',
				'priority' => 15,
			)
		)
	);

	$wp_customize->add_setting(
		'header_phone_tree',
		array(
			'default'           => '+7 (499) 755-76-73',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_phone_tree',
		array(
			'label'       => 'Телефон три',
			'description' => 'Укажите третий номер телефона',
			'type'        => 'text',
			'section'     => 'header_theme',
			'priority'    => 15,
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'header_phone_one',
		array(
			'selector'            => '.phone.one',
			'settings'            => 'header_phone_tree',
			'container_inclusive' => false,
			'render_callback'     => function () {
				return smd_text( 'header_phone_tree' );
			},
		)
	);

	$wp_customize->add_setting(
		'header_phone_tree_desc',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_phone_tree_desc',
		array(
			'label'       => 'Подпись Телефон три',
			'description' => 'Укажите подпись для телефона',
			'type'        => 'text',
			'section'     => 'header_theme',
			'priority'    => 15,
		)
	);

	$wp_customize->add_setting(
		'header_phone_line',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'header_phone_line',
			array(
				'section'  => 'header_theme',
				'priority' => 15,
			)
		)
	);

	$wp_customize->add_setting(
		'header_request',
		array(
			'default'           => 'Заказать звонок',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_request',
		array(
			'label'       => 'Надпись на кнопке',
			'description' => 'Укажите надпись на кнопке',
			'type'        => 'text',
			'section'     => 'header_theme',
			'priority'    => 20,
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'header_request',
		array(
			'selector'            => '.request',
			'settings'            => 'header_request',
			'container_inclusive' => false,
			'render_callback'     => function () {

				return smd_text( 'header_request' );
			},
		)
	);

	$wp_customize->add_setting(
		'header_request_switch',
		array(
			'default'           => 0,
			'transport'         => $transport,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Toggle_Switch_Custom_control(
			$wp_customize,
			'header_request_switch',
			array(
				'label'    => 'Не показывать кнопку',
				'section'  => 'header_theme',
				'type'     => 'toogle_switch',
				'priority' => 25,
			)
		)
	);

	$wp_customize->add_setting(
		'header_slider_line',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'header_slider_line',
			array(
				'section'  => 'header_theme',
				'priority' => 25,
			)
		)
	);

	$wp_customize->add_setting(
		'header_slider',
		array(
			'transport' => 'refresh',
			'type'      => 'option',
		)
	);
	$wp_customize->add_control(
		new Art_Images_Slider_Custom_Control(
			$wp_customize,
			'header_slider',
			array(
				'label'       => 'Слайдер',
				'description' => 'С помощью данных настроек выводиться слайдер над меню',
				'section'     => 'header_theme',
				'type'        => 'slider_images',
				'priority'    => 30,
			)
		)
	);

	$wp_customize->add_setting(
		'header_banners',
		array(
			'transport' => 'refresh',
			'type'      => 'option',
		)
	);
	$wp_customize->add_control(
		new Art_Images_Slider_Custom_Control(
			$wp_customize,
			'header_banners',
			array(
				'label'       => 'Баннеры',
				'description' => 'С помощью данных настроек выводиться список баннеров под меню',
				'section'     => 'header_theme',
				'type'        => 'slider_images',
				'priority'    => 35,
			)
		)
	);*/

	/**
	 * Add footer custom control Theme Customizer.
	 */
/*	$wp_customize->add_setting(
		'footer_title',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => '',
		)
	);
	$wp_customize->add_control(
		new Art_Title_Section_Custom_Control(
			$wp_customize,
			'footer_title',
			array(
				'label'       => 'Настройки подвала сайта',
				'description' => 'В данной секции можно управлять выводом данных в подвале',
				'section'     => 'footer_theme',
				'priority'    => 5,
			)
		)
	);
	$wp_customize->add_setting(
		'footer_logo',
		array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => $transport,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'footer_logo',
			array(
				'label'       => 'Логотип в подвале',
				'description' => 'Укажите изображение, которое будет логотипом в подвале',
				'width'       => 380,
				'height'      => 100,
				'section'     => 'footer_theme',
				'priority'    => 10,
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'footer_logo',
		array(
			'selector'            => '.logo-footer-container',
			'settings'            => 'footer_logo',
			'container_inclusive' => false,
			'render_callback'     => function () {

				return smd_image( 'footer_logo' );
			},
		)
	);

	$wp_customize->add_setting(
		'footer_logo_line',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'footer_logo_line',
			array(
				'section'  => 'footer_theme',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'footer_copyright',
		array(
			'default'           => 'Все права защищены',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'footer_copyright',
		array(
			'label'       => 'Копирайт',
			'description' => 'Укажите первый номер телефона',
			'type'        => 'text',
			'section'     => 'footer_theme',
			'priority'    => 15,
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'footer_copyright',
		array(
			'selector'            => '.copyright',
			'settings'            => 'footer_copyright',
			'container_inclusive' => false,
			'render_callback'     => function () {

				return smd_text( 'footer_copyright' );
			},
		)
	);

	$wp_customize->add_setting(
		'footer_copyright_line',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'footer_copyright_line',
			array(
				'section'  => 'footer_theme',
				'priority' => 15,
			)
		)
	);

	$wp_customize->add_setting(
		'footer_description',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_TinyMCE_Custom_control(
			$wp_customize,
			'footer_description',
			array(
				'label'       => 'Описание',
				'description' => 'В данном поле можно написать какое-то описание сайта',
				'type'        => 'tinymce_editor',
				'section'     => 'footer_theme',
				'priority'    => 20,
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'footer_description',
		array(
			'selector'            => '.footer-description',
			'settings'            => 'footer_description',
			'container_inclusive' => false,
			'render_callback'     => function () {

				return smd_text( 'footer_description' );
			},
		)
	);*/

	/**
	 * Add footer custom control Theme Customizer.
	 */
/*	$wp_customize->add_setting(
		'social_profile_settings',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'skyrocket_url_sanitization',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_Sortable_Repeater_Custom_Control(
			$wp_customize,
			'social_profile_settings',
			array(
				'label'         => 'Соцсети',
				'description'   => 'Укажите ссылки на профили в соцсетях',
				'section'       => 'social_profile',
				'button_labels' => array(
					'add' => 'Добавить',
				),
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'social_profile_settings',
		array(
			'selector'            => '.site-social',
			'settings'            => 'social_profile_settings',
			'container_inclusive' => false,
			'render_callback'     => 'smd_social',
		)
	);*/
	/**
	 * Add footer custom control Theme Customizer.
	 */
/*	$wp_customize->add_setting(
		'feedback_box_form',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'feedback_box_form',
		array(
			'label'       => 'Форма заявки',
			'description' => 'Здесь необходимо указать шорткод формы',
			'type'        => 'text',
			'section'     => 'feedback_box',
			'priority'    => 10,
		)
	);

	$wp_customize->add_setting(
		'feedback_box_line',
		array(
			'default'   => '',
			'transport' => $transport,
		)
	);
	$wp_customize->add_control(
		new Art_Final_Line_Section_Custom_Control(
			$wp_customize,
			'feedback_box_line',
			array(
				'section'  => 'feedback_box',
				'priority' => 15,
			)
		)
	);

	$wp_customize->add_setting(
		'feedback_box_description',
		array(
			'default'           => '',
			'transport'         => $transport,
			'type'              => 'option',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Skyrocket_TinyMCE_Custom_control(
			$wp_customize,
			'feedback_box_description',
			array(
				'label'       => 'Описание',
				'description' => 'В данном поле можно написать какое-то описание сайта',
				'type'        => 'tinymce_editor',
				'section'     => 'feedback_box',
				'priority'    => 20,
			)
		)
	);*/


}
add_action( 'customize_register', 'customize_register_options' );
