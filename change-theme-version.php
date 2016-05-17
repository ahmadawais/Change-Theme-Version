<?php
/**
 * Plugin Name: Change Theme Version
 * Plugin URI: http://AhmadAwais . com/
 * Description: Change the theme version programatically .
 * Author: mrahmadawais, WPTie
 * Author URI: http://AhmadAwais . com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www . gnu . org/licenses/gpl-2 . 0 . txt
 *
 * @package CTV
 */

// Exit if accessed directly .
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define global constants .
 *
 * @since 1 . 0 . 0
 */
// Plugin version .
if ( ! defined( 'CTV_VERSION' ) ) {
    define( 'CTV_VERSION', '1 . 0 . 0' );
}

if ( ! defined( 'CTV_NAME' ) ) {
    define( 'CTV_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

if ( ! defined('CTV_DIR' ) ) {
    define( 'CTV_DIR', WP_PLUGIN_DIR  .  '/'  .  CTV_NAME );
}

if ( ! defined('CTV_URL' ) ) {
    define( 'CTV_URL', WP_PLUGIN_URL  .  '/'  .  CTV_NAME );
}

/**
 * WPOSA.
 *
 * @since 1.0.0
 */
if ( file_exists( CTV_DIR . '/wposa/wposa-init.php' ) ) {
    require_once( CTV_DIR . '/wposa/wposa-init.php' );
}

if ( ! function_exists( 'ctv_replace_in_file' ) ) {
	/**
	 * Replaces a string in a file
	 *
	 * @param string $file_path Filepath.
	 * @param string $old_text text to be replaced.
	 * @param string $new_text new text.
	 * @return array $result status (success | error) & message (file exist, file permissions)
	 */
	function ctv_replace_in_file( $file_path, $old_text, $new_text ) {
	    $result = array( 'status' => 'error', 'message' => '' );
	    if ( true === file_exists( $file_path ) ) {
	        if ( is_writeable( $file_path ) ) {
	            try {
	                $file_content = file_get_contents( $file_path );
	                $file_content = str_replace( $old_text, $new_text, $file_content );
	                if ( file_put_contents( $file_path, $file_content) > 0 ) {
	                    $result["status"] = 'success';
	                }
	                else {
	                   $result["message"] = 'Error while writing file';
	                }
	            }
	            catch( Exception $e ) {
	                $result["message"] = 'Error : ' . $e;
	            }
	        }
	        else {
	            $result["message"] = 'File ' . $file_path . ' is not writable !';
	        }
	    }
	    else {
	        $result["message"] = 'File ' . $file_path . ' does not exist !';
	    }
	    return $result;
	}
}

// Theme path.
$ctv_theme_path = get_template_directory() . '/style.css';

// CTV Settings.
$ctv_settings = get_option( 'ctv_settings' );

// Old version.
$ctv_old_ver  = isset(  $ctv_settings['ctv_old_ver'] ) ?  $ctv_settings['ctv_old_ver'] : false;
$ctv_old_ver  = isset( $ctv_old_ver ) ? $ctv_old_ver : false;

// New version.
$ctv_new_ver  = isset(  $ctv_settings['ctv_new_ver'] ) ?  $ctv_settings['ctv_new_ver'] : false;
$ctv_new_ver  = isset( $ctv_new_ver ) ? $ctv_new_ver : false;

if ( false !== $ctv_old_ver && false !== $ctv_new_ver ) {
	// Change the them version.
	ctv_replace_in_file( $ctv_theme_path, $ctv_old_ver, $ctv_new_ver );
}
