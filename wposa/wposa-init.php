<?php
/**
 * WP OOP Settings API
 * Description WP-OOP-Settings-API is a Settings API wrapper built with Object Oriented Programming practices.
 * Author mrahmadawais, WPTie
 * Author URI: http://AhmadAwais.com/
 * Version 1.0.0
 * License GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package WPOSA
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * WP-OOP-Settings-API Initializer
 *
 * Initializes the WP-OOP-Settings-API.
 *
 * @since 	1.0.0
 */


/**
 * Class `WP_OSA_CTV`.
 *
 * @since 1.0.0
 */
if ( file_exists( CTV_DIR . '/wposa/class-wposa.php' ) ) {
    require_once( CTV_DIR . '/wposa/class-wposa.php' );
}


/**
 * Actions/Filters
 *
 * Related to all settings API.
 *
 * @since  1.0.0
 */
if ( class_exists( 'WP_OSA_CTV' ) ) {
	/**
	 * Object Instantiation.
	 *
	 * Object for the class `WP_OSA_CTV`.
	 */
	$wposa_obj = new WP_OSA_CTV();

    // Section: Basic Settings.
    $wposa_obj->add_section(
    	array(
			'id'    => 'ctv_settings',
			'title' => __( 'Settings', 'CTV' ),
		)
    );

    // Previous Version.
	$wposa_obj->add_field(
		'ctv_settings',
		array(
			'id'      => 'ctv_old_ver',
			'type'    => 'text',
			'name'    => __( 'Current Version (Required)', 'CTV' ),
			'desc'    => __( 'What is the current version?', 'CTV' ),
			'default' => '1.0.0.1'
		)
	);

    // New Version.
	$wposa_obj->add_field(
		'ctv_settings',
		array(
			'id'      => 'ctv_new_ver',
			'type'    => 'text',
			'name'    => __( 'New Version (Required)', 'CTV' ),
			'desc'    => __( 'Change the new version to what?', 'CTV' ),
			'default' => '1.0.0.1'
		)
	);

}
