<?php

namespace PXLS\CF8\Frontend;

class Assets{

    public function __construct(){

        add_action( 'wp_enqueue_scripts', [ $this, 'pxls_assets_register' ] );

    }


    public function pxls_assets_register(){


        wp_register_style( 

            'contact-form-1-css', 
            PXLS_CF8_ASSETS . '/css/contact-form-1.css', 
            [], 
            filemtime(__FILE__), 
            
       

        );

        wp_enqueue_style('contact-form-1-css');

    }




}
