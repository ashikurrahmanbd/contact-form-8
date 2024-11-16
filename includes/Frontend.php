<?php

namespace PXLS\CF8;

class Frontend{

    function __construct(){

        
        new Frontend\Assets();
        new Frontend\Shortcode(); 

    }

}