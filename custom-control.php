<?php

require __DIR__ . '/custom-controls/class-control-dropdown-select2.php';
require __DIR__ . '/custom-controls/class-control-final-line.php';
require __DIR__ . '/custom-controls/class-control-image-checkbox.php';
require __DIR__ . '/custom-controls/class-control-image-radio-button.php';
require __DIR__ . '/custom-controls/class-control-images-slider.php';
require __DIR__ . '/custom-controls/class-control-simple-notice.php';
require __DIR__ . '/custom-controls/class-control-single-accordion.php';
require __DIR__ . '/custom-controls/class-control-range-field.php';
require __DIR__ . '/custom-controls/class-control-sortable-repeater.php';
require __DIR__ . '/custom-controls/class-control-text-radio-button.php';
require __DIR__ . '/custom-controls/class-control-tinymce.php';
require __DIR__ . '/custom-controls/class-control-title-section.php';
require __DIR__ . '/custom-controls/class-control-toggle-switch.php';
require __DIR__ . '/custom-controls/class-custom-panel.php';
require __DIR__ . '/custom-controls/class-custom-section.php';

/**
 * URL sanitization
 *
 * @param  string    Input to be sanitized (either a string containing a single url or multiple, separated by commas)
 *
 * @return string    Sanitized input
 */
if ( ! function_exists( 'skyrocket_url_sanitization' ) ) {
	function skyrocket_url_sanitization( $input ) {

		if ( strpos( $input, ',' ) !== false ) {
			$input = explode( ',', $input );
		}
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[ $key ] = esc_url_raw( $value );
			}
			$input = implode( ',', $input );
		} else {
			$input = esc_url_raw( $input );
		}

		return $input;
	}
}

/**
 * Switch sanitization
 *
 * @param  string        Switch value
 *
 * @return integer    Sanitized value
 */
if ( ! function_exists( 'skyrocket_switch_sanitization' ) ) {
	function skyrocket_switch_sanitization( $input ) {

		/*$input = 1 ? 'yes' : 'no';
		return $input;*/
		if ( isset( $input ) && ! empty( $input ) ) {
			return 1;
		} else {
			return 0;
		}
	}
}

/**
 * Radio Button and Select sanitization
 *
 * @since Ephemeris 1.0
 *
 * @param  string        Radio Button value
 *
 * @return integer    Sanitized value
 */
if ( ! function_exists( 'skyrocket_radio_sanitization' ) ) {
	function skyrocket_radio_sanitization( $input, $setting ) {

		//get the list of possible radio box or select options
		$choices = $setting->manager->get_control( $setting->id )->choices;

		if ( array_key_exists( $input, $choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

/**
 * Integer sanitization
 *
 * @param  string        Input value to check
 *
 * @return integer    Returned integer value
 */
if ( ! function_exists( 'skyrocket_sanitize_integer' ) ) {
	function skyrocket_sanitize_integer( $input ) {

		return (int) sanitize_text_field( $input );
	}
}

/**
 * Text sanitization
 *
 * @param  string    Input to be sanitized (either a string containing a single string or multiple, separated by commas)
 *
 * @return string    Sanitized input
 */
if ( ! function_exists( 'skyrocket_text_sanitization' ) ) {
	function skyrocket_text_sanitization( $input ) {

		if ( strpos( $input, ',' ) !== false ) {
			$input = explode( ',', $input );
		}
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[ $key ] = sanitize_text_field( $value );
			}
			$input = implode( ',', $input );
		} else {
			$input = sanitize_text_field( $input );
		}

		return $input;
	}
}

/**
 * Alpha Color (Hex & RGBa) sanitization
 *
 * @param  string    Input to be sanitized
 *
 * @return string    Sanitized input
 */
if ( ! function_exists( 'skyrocket_hex_rgba_sanitization' ) ) {
	function skyrocket_hex_rgba_sanitization( $input, $setting ) {

		if ( empty( $input ) || is_array( $input ) ) {
			return $setting->default;
		}

		if ( false === strpos( $input, 'rgba' ) ) {
			// If string doesn't start with 'rgba' then santize as hex color
			$input = sanitize_hex_color( $input );
		} else {
			// Sanitize as RGBa color
			$input = str_replace( ' ', '', $input );
			sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			$input = 'rgba(' . skyrocket_in_range( $red, 0, 255 ) . ',' . skyrocket_in_range( $green, 0, 255 ) . ',' . skyrocket_in_range( $blue, 0, 255 ) . ',' .
			         skyrocket_in_range( $alpha, 0, 1 ) . ')';
		}

		return $input;
	}
}

/**
 * Only allow values between a certain minimum & maxmium range
 *
 * @param  number    Input to be sanitized
 *
 * @return number    Sanitized input
 */
if ( ! function_exists( 'skyrocket_in_range' ) ) {
	function skyrocket_in_range( $input, $min, $max ) {

		if ( $input < $min ) {
			$input = $min;
		}
		if ( $input > $max ) {
			$input = $max;
		}

		return $input;
	}
}

/**
 * Google Font sanitization
 *
 * @param  string    JSON string to be sanitized
 *
 * @return string    Sanitized input
 */
if ( ! function_exists( 'skyrocket_google_font_sanitization' ) ) {
	function skyrocket_google_font_sanitization( $input ) {

		$val = json_decode( $input, true );
		if ( is_array( $val ) ) {
			foreach ( $val as $key => $value ) {
				$val[ $key ] = sanitize_text_field( $value );
			}
			$input = wp_json_encode( $val );
		} else {
			$input = wp_json_encode( sanitize_text_field( $val ) );
		}

		return $input;
	}
}

/**
 * Date Time sanitization
 *
 * @param  string    Date/Time string to be sanitized
 *
 * @return string    Sanitized input
 */
if ( ! function_exists( 'skyrocket_date_time_sanitization' ) ) {
	function skyrocket_date_time_sanitization( $input, $setting ) {

		$datetimeformat = 'Y-m-d';
		if ( $setting->manager->get_control( $setting->id )->include_time ) {
			$datetimeformat = 'Y-m-d H:i:s';
		}
		$date = DateTime::createFromFormat( $datetimeformat, $input );

		if ( false === $date ) {
			$date = DateTime::createFromFormat( $datetimeformat, $setting->default );
		}

		return $date->format( $datetimeformat );
	}
}

/**
 * Customizer_Repeater Control
 *
 * @author  Cristian Ungureanu
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link    https://github.com/cristian-ungureanu/customizer-repeater
 */

function customizer_repeater_sanitize( $input ) {

	$input_decoded = json_decode( $input, true );
	if ( ! empty( $input_decoded ) ) {
		foreach ( $input_decoded as $boxk => $box ) {
			foreach ( $box as $key => $value ) {
				$input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );
			}
		}

		return wp_json_encode( $input_decoded );
	}

	return $input;
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function smd_customize_partial_blogname() {

	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function smd_customize_partial_blogdescription() {

	bloginfo( 'description' );
}

function smd_image( $name_option ) {

	return wp_get_attachment_image(
		esc_attr( $name_option ),
		'full'
	);
}

function smd_text( $name_option ) {

	return esc_attr( get_option( $name_option ) );
}

function smd_social() {

	$social_icons = explode(
		',',
		esc_url( get_option( 'social_profile_settings' ) )
	);

	return $social_icons;
}
