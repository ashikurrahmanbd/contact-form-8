<?php

namespace PXLS\CF8\Admin;

class Cpt{

    public function __construct(){

        add_action( 'init', [$this, 'register_cf8_post_type'] );

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





}