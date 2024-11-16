<?php

namespace PXLS\CF8\Frontend;

class Shortcode{

    function __construct(){

        add_shortcode( 'cf8', [$this, 'pxls_cf8_form_shortcode']);

    }



    public function pxls_cf8_form_shortcode( $atts, $content ){

        shortcode_atts(

            array(
                'id' => ''
            ), 
            $atts, 
            'cf8'
        );

        $selected_form_template = get_post_meta( $atts['id'], 'pxls_cf8_selected_form', true ) ?: '';

        $forms_dir = plugin_dir_path( __FILE__ ) . '/forms';

        //determine which template to include
        $template_file = '';

        switch( $selected_form_template ){

            case 'contact_form_1':
                $template_file = $forms_dir . '/contact_form_1.php';
                break;
            
            case 'contact_form_2':
                $template_file = $forms_dir . '/contact_form_2.php';
                break;

            default:
                $template_file = $forms_dir . '/contact_form_default.php';
                break;
            

        }

        if( file_exists( $template_file ) ){

            ob_start();

            include_once $template_file;


            return ob_get_clean();

        }else{

            return '<p>Template not found.</p>';

        }

        
 
    }

}