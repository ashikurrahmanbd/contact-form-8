<?php

namespace PXLS\CF8\Admin;

class Menu{

    function __construct(){

        add_action( 'admin_menu', [$this, 'plugin_menu'] );

    }


    public function plugin_menu(){

        $menu_slug = 'pxls-cf8';

        add_menu_page( 
            
            __('Contact Form 8', 'contact-form-8'), 
            __('Contact Form 8', 'contact-form-8'), 
            'manage_options', 
            $menu_slug, 
            [$this, 'pxls_cf8_menu_page_callback'], 
            'dashicons-email-alt2', 
           
            
        );

        

        add_submenu_page( 

            $menu_slug, 
            __('Add New', 'contact-form-8'), 
            __('Add New', 'contact-form-8'), 
            'manage_options', 
            'post-new.php?post_type=pxls-cf8',
          

        );

    }


    /**
     * Plugin Menu Page
     */

    public function pxls_cf8_menu_page_callback(){


        echo "hello";


    }
}