<?php

/**
 * Plugin Name: Contact Form 8
 * Author: Ashikur Rahman
 * Author URI: https://pixelese.com/ashikur-rahman
 * Description: A Classic Contact Form.
 * Version: 1.0
 * Tags: contact form, form, wp, contact form 8
 * License: GPLv2 or later
 * Text Domain: contact-form-8
 * Domain Path: /languages
 */

if ( ! defined('ABSPATH') ) {

    exit;

}

require_once __DIR__ . '/vendor/autoload.php';

final class ContactForm8{

    const version = '1.0';

    private function __construct(){

        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'plugin_activate'] );

        add_action( 'plugins_loaded', [$this, 'load_dependencies']);

    }

    /**
     * Singleton instance
     * 
     */
    public static function get_instance(){

        static $instance = null;

        if ( $instance === null ) {

            $instance = new self();

        }

        return $instance;

    }


    /**
     * define constants
     */

    public function define_constants(){

        define('PXLS_CF8_VERSION', self::version );

        define( 'PXLS_CF8_FILE', __FILE__ );

        define( 'PXLS_CF8_PATH', __DIR__ );

        define( 'PXLS_CF8_URL', plugins_url( '', __FILE__ ) );

        define( 'PXLS_CF8_ASSETS',  PXLS_CF8_URL . '/assets' );

    }


    /**
     * Plugiin Activate
    */
    public function plugin_activate(){

        $pxls_cf8_installed = get_option( 'pxls_cf8_installed' );

        if ( ! $pxls_cf8_installed ) {

            update_option( 'pxls_cf8_installed', time() );

        }

        update_option( 'pxls_cf8_installed_version', self::version );

    }

    /**
     * Load Dependencies
     */

    public function load_dependencies(){

        if ( is_admin(  ) ) {

            new PXLS\CF8\Admin();

        }else{

            new PXLS\CF8\Frontend();

        }
    
    }




}


/**
 * Return plugin instance
 */

function pxls_cf8(){

    return ContactForm8::get_instance();

}


/**
 * Kick of the plugin
 */

pxls_cf8();
