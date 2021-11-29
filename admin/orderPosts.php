<?php
    
    //require './../../../../wp-config.php';
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );    

    $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //$paged = $_POST['page'];
    //$type = $_POST['type'];
    //$category = $_POST['category'];
    //if(isset($form)):

        $id = $_POST['idPost'];
        $val= $_POST['count'];

        wpb_set_count_post($id, $val);
        //echo "executou";
    //else:
        //echo "no forming";
    //endif;