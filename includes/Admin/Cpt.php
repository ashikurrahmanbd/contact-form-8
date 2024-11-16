<?php

namespace PXLS\CF8\Admin;

class Cpt{

    public function __construct(){

        add_action( 'init', [$this, 'register_cf8_post_type'] );

        add_action( 'add_meta_boxes', [$this, 'pxls_cf8_metaboxes'] );

        add_action( 'save_post', [$this, 'pxls_cf8_form_selection_meta_box_data_save'] );

    }


    public function register_cf8_post_type(){

        $labels = array(

            'name'  => __('Contact Forms', 'contact-form-8'),
            'singular_name' => __('Contact Form', 'contact-form-8'),

            'add_new'            => __('Add New', 'contact-form-8'),
            'add_new_item'       => __('Add New Form', 'contact-form-8'),
            'new_item'           => __('New Form', 'contact-form-8'),
            'edit_item'          => __('Edit Form', 'contact-form-8'),
            'view_item'          => __('View Form', 'contact-form-8'),
            'all_items'          => __('All Forms', 'contact-form-8'),
            'search_items'       => __('Search Form', 'contact-form-8'),
            'parent_item_colon'  => __('Parent Form:', 'contact-form-8'),
            'not_found'          => __('No Form found.', 'contact-form-8'),
            'not_found_in_trash' => __('No Form found in Trash.', 'contact-form-8')


        );

        $args = array(
          
            'labels'    => $labels,
            'public'    => true,
            'show_ui'   => true,
            'show_in_menu'  => 'pxls-cf8',
            'capability_type'   => 'post',
            'supports'      => array('title'),
            'has_archive'   => false,


        );

        register_post_type( 'pxls-cf8', $args );

    }

    /**
     * 
     * Meta boxes
     */

    public function pxls_cf8_metaboxes(){

        add_meta_box(

            'pxls_cf8_select_form_metabox', 
            'Select Form', 
            [$this, 'pxls_cf8_select_form_metabox'], 
            'pxls-cf8', 
            'normal', 
            'default',  

        );

        //metabox for shortcode generate
        add_meta_box(

            'pxls_cf8_shortcode_generate', 
            'Shortcode', 
            [$this, 'pxls_cf8_shortcode_generate_callback'], 
            'pxls-cf8', 
            'side', 
            'default',  

        );

    }


    /**
     * Meta box callback
     */
    public function pxls_cf8_select_form_metabox($post){

        wp_nonce_field( 'pxls_cf8_form_selection_metabox_action', 'pxls_cf8_form_selection_metabox_nonce');

        $selected_form = get_post_meta( $post->ID, 'pxls_cf8_selected_form', true ) ?: '';

        
        
        ?>

        <div class="form-selection">
            <select name="pxls_cf8_form_selection" id="pxls_cf8_form_selection">
                <option value="">Select Form</option>
                <option value="contact_form_1" <?php selected($selected_form, 'contact_form_1'); ?>>Contact Form 1</option>
                <option value="contact_form_2" <?php selected($selected_form, 'contact_form_2'); ?>>Contact Form 2</option>
                <option value="contact_form_3" <?php selected($selected_form, 'contact_form_3'); ?>>Contact Form 3</option>
                <option value="contact_form_4" <?php selected($selected_form, 'contact_form_4'); ?>>Contact Form 4</option>
            </select>
        </div>

        <?php


    }


    /**
     * Meta box data save
     */

     public function pxls_cf8_form_selection_meta_box_data_save($post_id){

        if (
            !isset($_POST['pxls_cf8_form_selection_metabox_nonce']) ||!wp_verify_nonce($_POST['pxls_cf8_form_selection_metabox_nonce'], 'pxls_cf8_form_selection_metabox_action')){

            return;

        }

        // Check for autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
    
        // Check user permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }


        // Save metadata
        if (isset($_POST['pxls_cf8_form_selection'])) {

            $selected_form = sanitize_text_field($_POST['pxls_cf8_form_selection']);
            update_post_meta($post_id, 'pxls_cf8_selected_form', $selected_form);

        } else {

            // If the field is empty, delete the meta to clean up
            delete_post_meta($post_id, 'pxls_cf8_selected_form');

        }



    }


    //shortcode geneate callback
    public function pxls_cf8_shortcode_generate_callback($post){

        echo '<p style="font-size:15px;">[cf8 id="'. $post->ID .'"]</p>';

    }





}