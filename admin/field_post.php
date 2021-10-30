<?php

function cmb_field_post(){
    /*
    $cmb_post_field = new_cmb2_box([
        'id' => 'cmb_post_field_id',
        'title' => 'Banner',
        'object_types' => 'post'
    ]);
    $cmb_post_field->add_field([
        'id' => 'cmb_area_banner_code',
        'name' => 'Área do banner',
        'desc' => 'espaço para o script',
        'type' => 'textarea_code'
        
    ]);

    */
}
add_action('cmb2_admin_init', 'cmb_field_post');

?>