<?php
/**
 * Plugin Name:     Lanco Redirect
 * Plugin URI:      http://lancopaints.com
 * Description:     Redirects visitors to the right site base on location
 * Author:          Cristian Araya J.
 * Author URI:      http://teahdigital.com
 * Text Domain:     lanco-redirect
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Lanco_Redirect
 */
define('LANCOR_PATH', __DIR__);
define('LANCOR_VERSION', '0.1.0');

require LANCOR_PATH . '/vendor/autoload.php';

function lancor_get_instance() {
	return Lancor\Redirect::get_instance();
}

add_action( 'plugins_loaded', [ lancor_get_instance(), 'hooks' ] );
