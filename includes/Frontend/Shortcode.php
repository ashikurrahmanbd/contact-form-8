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

        $heading = get_post_meta( $atts['id'], 'pxls_cf8_cf_heading', true);

        $subheading = get_post_meta( $atts['id'], 'pxls_cf8_cf_subheading', true);

        $reciever_email = get_post_meta( $atts['id'], 'pxls_cf8_cf_reciever_email', true);

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


            if (isset($_POST['pxls_cf8_form_submit'])) {

                
                $name = isset($_POST['pxls_cf8_form_name']) ? sanitize_text_field($_POST['pxls_cf8_form_name']) : '';
            
                
                $email = isset($_POST['pxls_cf8_form_email']) ? sanitize_email($_POST['pxls_cf8_form_email']) : '';
            
              
                $message = isset($_POST['pxls_cf8_form_message']) ? sanitize_textarea_field($_POST['pxls_cf8_form_message']) : '';
            
                // Optional: Perform server-side validation
                if (empty($name) || empty($email) || empty($message)) {

                    echo 'All fields are required.';

                } elseif (!is_email($email)) {

                    echo 'Invalid email address.';

                } else {
                    
                    $reciver = $reciever_email;

                    $subject = 'New Contact Form Submission';

                    $body = "Name: $name\nEmail: $email\nMessage:\n$message";

                    $headers = ['Content-Type: text/plain; charset=UTF-8'];
                
                    if (wp_mail($reciver, $subject, $body, $headers)) {

                        echo '<p style="text-align:center; color: #008000;">Email sent successfully!</p>';

                    } else {

                        echo 'Failed to send email.';

                    }

                }
            }



            return ob_get_clean();

        }else{

            return '<p>Template not found.</p>';

        }

        
 
    }

}