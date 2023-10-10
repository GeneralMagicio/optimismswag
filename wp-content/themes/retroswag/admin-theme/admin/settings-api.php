<?php

/**
 * Plugin Name: WordPress Settings API
 * Plugin URI: http://tareq.wedevs.com/2012/06/wordpress-settings-api-php-class/
 * Description: WordPress Settings API testing
 * Author: Tareq Hasan
 * Author URI: http://tareq.weDevs.com
 * Version: 0.1
 */
require_once dirname( __FILE__ ) . '/class.settings-api.php';

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('WeDevs_Settings_API_page' ) ):

class WeDevs_Settings_API_page {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'Site Settings', 'Site Settings', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wedevs_basics',
                'title' => __( 'Basic Settings', 'wedevs' )
            ),
            array(
                'id' => 'wedevs_socials',
                'title' => __( 'Social Settings', 'wpuf' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(

            'wedevs_basics' => array(
	            array(
                    'name'  =>  'header_top_mobile',
                    'label' =>  __( 'Header Top Telephone', 'wedevs' ),
                    'desc'  =>  __( '+385 99 999 999', 'wedevs' ),
                    'type'  =>  'text',
                ),
                array(
                    'name'  =>  'header_top_email',
                    'label' =>  __( 'Header Top Email', 'wedevs' ),
                    'desc'  =>  __( 'mail@mail.com', 'wedevs' ),
                    'type'  =>  'text',
                ),
            ),

            'wedevs_socials' => array(
	            array(
                    'name' => 'facebook_url',
                    'label' => __( 'Facebook URL', 'wedevs' ),
                    'type' => 'text',
                    'desc' => 'https://web.facebook.com/',
                ),
                array(
                    'name' => 'twitter_url',
                    'label' => __( 'Twitter URL', 'wedevs' ),
                    'type' => 'text',
                    'desc' => 'https://twitter.com/',
                ),
            ),
           
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

$settings = new WeDevs_Settings_API_page();