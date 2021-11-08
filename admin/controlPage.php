<?php

function add_new_menu_items(){

    //Add um item de menu. This is a top level menu item i.e., this menu item can have sub menus
    add_menu_page(
        "Configuração Geral", //Required. esse é o título da página do menu
        "Configuração do tema", //Required. Texto do menu
        "manage_options", //Required. The required capability of users to access this menu item.
        "theme-options", //Required. identificador único desse menu
        "callback_links_popup", //Optional. This callback outputs the content of the page associated with this menu item.
        "", //Optional. The URL to the menu item icon.
        100 //Optional. Position of the menu item in the menu.
    );
    
    
    add_submenu_page(
        "theme-options",
        "Configuração de Posts",
        "Configuração de Posts",
        "manage_options",
        "options_list_posts",
        "callback_posts_option"
    );

    add_submenu_page(
        "theme-options", //Required. Slug of top level menu item
        "Ads", //Required. Text to be displayed in title.
        "Ads", //Required. Text to be displayed in menu.
        "manage_options", //Required. The required capability of users.
        "options_ads", //Required. A unique identifier to the sub menu item.
        "callback_options_ads", //Optional. This callback outputs the content of the page associated //with this menu item.
        "" //Optional. The URL of the menu item icon
    );

    add_submenu_page(
        "theme-options",
        "Rodapé",
        "Rodapé",
        "manage_options",
        "options_rodape",
        "callback_options_rodape"
    );

}

function callback_links_popup(){
    ?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"></div><!-- run the settings_errors() function here. -->
        <?php settings_errors(); ?>
        <h1>Configurações dos links</h1>
        <form method="post" action="options.php">
            <?php
            
                //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                settings_fields("links_popup_section");
                
                // all the add_settings_field callbacks is displayed here
                do_settings_sections("theme-options");
            
                // Add the submit button to serialize the options
                submit_button();
                
            ?>         
        </form>
    </div>
    <?php
}

function callback_posts_option(){
    ?>
    <div>
        
        <?php settings_errors(); ?>
        <h1>Configuração da exibição dos Posts</h1>
        <form method="post" action="options.php">
            <?php
            
                //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                settings_fields("posts_section");
                
                // all the add_settings_field callbacks is displayed here
                
                do_settings_sections("options_list_posts");

                // Add the submit button to serialize the options
                submit_button();
                
            ?>         
        </form>
    </div>
    <?php
}
function callback_options_ads(){
    ?>
    <div>
        <?php settings_errors(); ?>
        <h1>Configuração dos anúncios</h1>
        <form method="post" action="options.php">
            <?php
            
                //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                settings_fields("ads_section");
                
                // all the add_settings_field callbacks is displayed here
                do_settings_sections("options_ads");
            
                // Add the submit button to serialize the options
                submit_button();
                
            ?>         
        </form>
    </div>
    <?php
}
function callback_options_rodape(){
    ?>
    <div>
        <?php settings_errors(); ?>
        <h1>Configuração dos anúncios</h1>
        <form method="post" action="options.php">
            <?php
            
                //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                settings_fields("rodape_section");
                
                // all the add_settings_field callbacks is displayed here
                do_settings_sections("options_rodape");
            
                // Add the submit button to serialize the options
                submit_button();
                
            ?>         
        </form>
    </div>
    <?php
}
add_action("admin_menu", "add_new_menu_items");



//fields para a section de config dos links e popups ======================================================================
function display_fields_links_acesse_conta(){
    add_settings_section("links_popup_section", "", "display_links_popup", "theme-options");

    add_settings_field("link_acesse_conta", "Link de 'Acesse sua conta'", "display_link_conta", "theme-options", "links_popup_section");

    register_setting("links_popup_section", "link_acesse_conta");
}
function display_links_popup(){
    ?>
        <hr>
        <h2>Configuração de links</h2>
    <?php
}
add_action("admin_init", "display_fields_links_acesse_conta");


function display_fields_popup(){
    add_settings_section("popup_section", "", "display_popup", "theme-options");

    add_settings_field("popup_link", "Link da Popup", "display_link_popup", "theme-options", "popup_section");
    add_settings_field("popup_aviso_link", "Texto do link da Popup", "display_link_aviso_popup", "theme-options", "popup_section");
    add_settings_field("popup_aviso_label", "Texto do Label da Popup", "display_popup_aviso_label", "theme-options", "popup_section");
    add_settings_field("popup_aviso_label_color", "Cor do label", "display_popup_aviso_label_color", "theme-options", "popup_section");
    add_settings_field("popup_icon_attachment_id", "ícone da Popup", "display_icon_popup", "theme-options", "popup_section");
    add_settings_field("popup_color", "Cor da Popup", "display_popup_color", "theme-options", "popup_section");
    add_settings_field("popup_cookie", "Controle de exibição", "display_cookie_popup", "theme-options", "popup_section");
    add_settings_field("setup_popup_cookie", "", "display_setup_cookie_popup", "theme-options", "popup_section");
    add_settings_field("popup_show", "Oculpar Popup em", "display_show_popup", "theme-options", "popup_section");
    add_settings_field("onoff_popup", "ON/OFF Popup", "display_onoff_popup", "theme-options", "popup_section");

    register_setting("links_popup_section", "popup_link");
    register_setting("links_popup_section", "popup_aviso_link");
    register_setting("links_popup_section", "popup_aviso_label");
    register_setting("links_popup_section", "popup_aviso_label_color");
    register_setting("links_popup_section", "popup_icon_attachment_id");
    register_setting("links_popup_section", "popup_color");
    register_setting("links_popup_section", "popup_cookie");
    register_setting("links_popup_section", "setup_popup_cookie");
    register_setting("links_popup_section", "popup_show");
    register_setting("links_popup_section", "onoff_popup");
}
function display_popup(){
    ?>
        <hr>
        <h2>Popup de aviso</h2>
    <?php
}
add_action("admin_init", "display_fields_popup");
//fields para a section de config dos links e popups ======================================================================

function display_link_popup(){
    ?>
        <input type="url" name="popup_link" id="popup_link" value="<?= get_option('popup_link'); ?>">
    <?php
}
function display_link_aviso_popup(){
    ?>
        <input type="text" name="popup_aviso_link" id="popup_aviso_link" value="<?= get_option('popup_aviso_link'); ?>">
    <?php
}
function display_popup_aviso_label(){
    ?>
        <input type="text" name="popup_aviso_label" id="popup_aviso_label" value="<?= get_option('popup_aviso_label'); ?>">
    <?php
}
function display_popup_aviso_label_color(){
    $color_label = get_option('popup_aviso_label_color');
    ?>
        <style>
            .btn_reset_color_label{
                display: inline;
                border: none;
                height: 27px;
                width: 27px;
                padding: 2px;
                border: 1px solid #333;
                border-radius: 50%;
                color: #000;
                font-size: 1.4em;
                font-weight: 600;
            }
            .btn_reset_color_label:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="popup_aviso_label_color" id="popup_aviso_label_color" value="<?= $color_label != "" ? $color_label : "#3E659A"; ?>">
        <span class="btn_reset_color_label">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_label").addEventListener("click", function(){
                document.getElementById("popup_aviso_label_color").value = "#3E659A";
            });
        </script>
    <?php
}
function display_popup_color(){
    $color_popup = get_option('popup_color');
    ?>
        <style>
            .btn_reset_color_popup{
                display: inline;
                border: none;
                height: 27px;
                width: 27px;
                padding: 2px;
                border: 1px solid #333;
                border-radius: 50%;
                color: #000;
                font-size: 1.4em;
                font-weight: 600;
            }
            .btn_reset_color_popup:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="popup_color" id="popup_color" value="<?= $color_popup != " " ? $color_popup : "#5B90B9"; ?>">
        <span class="btn_reset_color_popup">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_popup").addEventListener("click", function(){
                document.getElementById("popup_color").value = "#5B90B9";
            });
        </script>
    <?php
}
function display_icon_popup(){
    ?>
        
        <?php $id_image = get_option('popup_icon_attachment_id'); ?>
        <img src="<?= wp_get_attachment_image_url( $id_image, 'thumbnail' ); ?>" alt="" srcset="">
         
        
        <?php
if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['popup_icon_attachment_id'] ) ) :
        update_option( 'media_selector_attachment_id', absint( $_POST['popup_icon_attachment_id'] ) );
    endif;
    wp_enqueue_media();
    ?>
        <div class='image-preview-wrapper'>
            <img  style="max-width: 200px" id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' width='200'>
        </div>
        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Atualizar imagem' ); ?>" />
        <input type='hidden' name='popup_icon_attachment_id' id='popup_icon_attachment_id' value='<?php echo get_option( 'popup_icon_attachment_id' ); ?>'>
        <input type="submit" name="submit_image_selector" value="Salvar" class="button-primary">
    
<?php


$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
    ?><script type='text/javascript'>
        jQuery( document ).ready( function( $ ) {
            // Uploading files
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
            var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
            jQuery('#upload_image_button').on('click', function( event ){
                event.preventDefault();
                // If the media frame already exists, reopen it.
                
                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Selecione a imagem',
                    button: {
                        text: 'Usar imagem',
                    },
                    multiple: false // Set to true to allow multiple files to be selected
                });
                // When an image is selected, run a callback.
                file_frame.on( 'select', function() {
                    // We set multiple to false so only get one image from the uploader
                    attachment = file_frame.state().get('selection').first().toJSON();
                    // Do something with attachment.id and/or attachment.url here
                    $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                    $( '#popup_icon_attachment_id' ).val( attachment.id );
                    // Restore the main post ID
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
                    // Finally, open the modal
                    file_frame.open();
            });
            // Restore the main ID when the add media button is pressed
            jQuery( 'a.add_media' ).on( 'click', function() {
                wp.media.model.settings.post.id = wp_media_post_id;
            });
        });
    </script>
    
    <?php
    
}

function display_cookie_popup(){
    $option_popup_cookie = get_option('popup_cookie');
    ?>
        <select name="popup_cookie" id="popup_cookie">
            <option value="always" <?= $option_popup_cookie == "always" ? "selected" : "" ?>>Sempre exibir ao acessar o site</option>
            <option value="custom" <?= $option_popup_cookie == "custom" ? "selected" : "" ?>>Personalizar</option>
        </select>
    <?php
}
function display_setup_cookie_popup(){
    $option_dias_cookie = get_option('setup_popup_cookie');
    $option_popup_cookie = get_option('popup_cookie');
    ?>
    <div id="choose_days"  style="display: <?= $option_popup_cookie == "custom" ? "block" : "none"; ?>">
        <strong>Não exibir novamente após usuário fechar janela no intervalo de <input type="number" name="setup_popup_cookie" id="setup_popup_cookie" value="<?= !empty($option_dias_cookie) ? $option_dias_cookie : ""; ?>" style="width: 64px"> dia(s)</strong>
    </div>
    <script>
        document.getElementById("popup_cookie").addEventListener("change", function(){
            var val_popup_cookie = document.getElementById("popup_cookie");
            if(val_popup_cookie.value == "custom"){
                document.getElementById("choose_days").style.display = "block";
            }else{
                document.getElementById("choose_days").style.display = "none";
            }
        });
    </script>
    <?php
}

function display_show_popup(){
    $option_show_popup = get_option('popup_show');
    ?>
        <select name="popup_show" id="popup_show">
            <option value="no">nenhum</option>
            <option value="mobile" <?= $option_show_popup == "mobile" ? "selected" : ""; ?>>Mobile</option>
            <option value="mobile&tablet" <?= $option_show_popup == "mobile&tablet" ? "selected" : ""; ?>>Mobile/tablet</option>
            <option value="desktop" <?= $option_show_popup == "desktop" ? "selected" : ""; ?>>Desktop/laptop</option>
        </select>
    <?php
}
function display_onoff_popup(){
    ?>
        <style>.switch{position:relative;display:inline-block;width:50px;height:24px}.switch input{opacity:0;width:0;height:0}.slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:green;-webkit-transition:.4s;transition:.4s}.slider:before{position:absolute;content:"";height:16px;width:16px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider{background-color:#999}input:focus+.slider{box-shadow:0 0 1px #2196f3}input:checked+.slider:before{-webkit-transform:translateX(26px);-ms-transform:translateX(26px);transform:translateX(26px)}.slider.round{border-radius:34px}.slider.round:before{border-radius:50%}</style>
        <label class="switch">
            <input type="checkbox" name="onoff_popup" id="onoff_popup" <?= get_option('onoff_popup') == "on" ? "checked" : "" ?>>
            <span class="slider round"></span>
        </label>
    <?php
}



//fields para a section de config posts slide ======================================================================
add_action("admin_init", "display_fields_posts_slide");
function display_fields_posts_slide(){
    
    add_settings_section("posts_section_slide", "", "display_posts_options_content", "options_list_posts");

    add_settings_field("show_slide_post", "Forma de listagem dos slider post", "display_slide_post", "options_list_posts", "posts_section_slide");
    add_settings_field("show_slide_post_category", "", "display_slide_post_category", "options_list_posts", "posts_section_slide");
    add_settings_field("show_slide_post_keyword", "", "display_slide_post_keyword", "options_list_posts", "posts_section_slide");
    add_settings_field("show_pina_slide_post", "Fixar primeiro post do slide", "display_pina_slide_post", "options_list_posts", "posts_section_slide");
    add_settings_field("show_lista_posts_slide", "", "display_lista_posts_slide", "options_list_posts", "posts_section_slide");add_settings_field("show_slide_post_count", "Contagem de Posts", "display_slide_post_count", "options_list_posts", "posts_section_slide");

    register_setting("posts_section", "show_slide_post");
    register_setting("posts_section", "show_slide_post_count");
    register_setting("posts_section", "show_slide_post_category");
    register_setting("posts_section", "show_slide_post_keyword");
    register_setting("posts_section", "show_pina_slide_post");
    register_setting("posts_section", "show_lista_posts_slide");
}

function display_posts_options_content(){
    ?>
    <hr>
        <h2>Configuração da listagem de Posts do Slide</h2>
    <?php
}
//fields para a section de config posts slide ======================================================================




//fields para a section de config posts sidebar ======================================================================
add_action("admin_init", "display_fields_posts_sidebar");
function display_fields_posts_sidebar(){
    add_settings_section("posts_section","", "display_posts_options_content_sidebar", "options_list_posts");

    add_settings_field("show_sidebar_post", "Forma de listagem dos posts laterais (Artigos mais lidos)", "display_sidebar_post", "options_list_posts", "posts_section");
    add_settings_field("show_sidebar_post_category", "", "display_sidebar_post_category", "options_list_posts", "posts_section");
    add_settings_field("show_sidebar_post_keyword", "", "display_sidebar_post_keyword", "options_list_posts", "posts_section");
    add_settings_field("show_pina_sidebar_post", "Fixar primeiro Post no sidebar", "display_pina_sidebar_post", "options_list_posts", "posts_section");
    add_settings_field("show_lista_posts_sidebar", "", "display_lista_posts_sidebar", "options_list_posts", "posts_section");
    add_settings_field("show_sidebar_post_count", "Contagem de Posts", "display_sidebar_post_count", "options_list_posts", "posts_section");

    register_setting("posts_section", "show_sidebar_post");
    register_setting("posts_section", "show_sidebar_post_count");
    register_setting("posts_section", "show_sidebar_post_category");
    register_setting("posts_section", "show_sidebar_post_keyword");
    register_setting("posts_section", "show_pina_sidebar_post");
    register_setting("posts_section", "show_lista_posts_sidebar");
}
function display_posts_options_content_sidebar(){
    ?>
        <hr>
        <h2>Configuração dos Posts Sidebar</h2>
    <?php
}
//fields para a section de config posts slide ======================================================================

//fields para o ads sidebar ===================================================
function display_fields_ads_sidebar(){
    add_settings_section("section_ads_sidebar", "", "display_option_ads_sidebar", "options_ads");

    add_settings_field("show_img_ads_sidebar", "Imagem Ads", "display_img_ads_sidebar", "options_ads", "section_ads_sidebar");
    add_settings_field("show_title_ads_sidebar", "Title Ads", "display_title_ads_sidebar", "options_ads", "section_ads_sidebar");
    add_settings_field("show_text_ads_sidebar", "Texto Ads", "display_text_ads_sidebar", "options_ads", "section_ads_sidebar");
    add_settings_field("show_link_ads_sidebar", "Link Ads", "display_link_ads_sidebar", "options_ads", "section_ads_sidebar");
    add_settings_field("show_cta_ads_sidebar", "CTA Ads", "display_cta_ads_sidebar", "options_ads", "section_ads_sidebar");
    add_settings_field("show_onoff_ads_sidebar", "ON/OFF Ads", "display_onoff_ads_sidebar", "options_ads", "section_ads_sidebar");

    register_setting("ads_section", "show_img_ads_sidebar");
    register_setting("ads_section", "show_title_ads_sidebar");
    register_setting("ads_section", "show_text_ads_sidebar");
    register_setting("ads_section", "show_link_ads_sidebar");
    register_setting("ads_section", "show_cta_ads_sidebar");
    register_setting("ads_section", "show_onoff_ads_sidebar");
}
add_action("admin_init", "display_fields_ads_sidebar");

function display_option_ads_sidebar(){
    ?>
        <h2>Anúncio Sidebar</h2>
    <?php
}
function display_img_ads_sidebar(){
    ?>
    
    <?php //$id_image = get_option('show_img_ads_sidebar'); ?>
        <!-- 
        <img style="max-width: 100px" src="<?php //wp_get_attachment_image_url( $id_image, 'normal' ); ?>" alt="" srcset="">
         -->
    <?php
    if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['show_img_ads_sidebar'] ) ) :
        update_option( 'media_selector_attachment_id', absint( $_POST['show_img_ads_sidebar'] ) );
    endif;
    wp_enqueue_media();
    ?>
    
        <div class='image-preview-wrapper'>
            <img style="max-width: 200px" id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'show_img_ads_sidebar' ) ); ?>' width='200'>
        </div>
         
        <input style="display: block" id="upload_image_button2" type="button" class="button" value="<?php _e( 'Atualizar imagem' ); ?>" />
        <input type='hidden' name='show_img_ads_sidebar' id='show_img_ads_sidebar' value='<?php echo get_option( 'show_img_ads_sidebar' ); ?>'>
        <!-- 
        <input type="submit" name="submit_image_selector" value="Salvar" class="button-primary">
     -->
    
<?php


$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
    ?><script type='text/javascript'>
        jQuery( document ).ready( function( $ ) {
            // Uploading files
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
            var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
            jQuery('#upload_image_button2').on('click', function( event ){
                event.preventDefault();
                // If the media frame already exists, reopen it.
                
                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Selecione a imagem',
                    button: {
                        text: 'Usar imagem',
                    },
                    multiple: false // Set to true to allow multiple files to be selected
                });
                // When an image is selected, run a callback.
                file_frame.on( 'select', function() {
                    // We set multiple to false so only get one image from the uploader
                    attachment = file_frame.state().get('selection').first().toJSON();
                    // Do something with attachment.id and/or attachment.url here
                    $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                    $( '#show_img_ads_sidebar' ).val( attachment.id );
                    // Restore the main post ID
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
                    // Finally, open the modal
                    file_frame.open();
            });
            // Restore the main ID when the add media button is pressed
            jQuery( 'a.add_media' ).on( 'click', function() {
                wp.media.model.settings.post.id = wp_media_post_id;
            });
        });
    </script>
    
    <?php
}
function display_title_ads_sidebar(){
    $val_title_ads_sidebar = get_option('show_title_ads_sidebar');
    ?>
        <input type="text" name="show_title_ads_sidebar" id="show_title_ads_sidebar" value="<?= $val_title_ads_sidebar != "" ? $val_title_ads_sidebar : ""; ?>" style="width: 400px;">
    <?php
}
function display_text_ads_sidebar(){
    ?>
        <textarea name="show_text_ads_sidebar" id="show_text_ads_sidebar">
            <?= get_option('show_text_ads_sidebar'); ?>
        </textarea>
        
       

    <?php
}
function display_link_ads_sidebar(){
    $val_link_ads_sidebar = get_option('show_link_ads_sidebar');
    ?>
        <input type="url" name="show_link_ads_sidebar" id="show_link_ads_sidebar" value="<?= $val_link_ads_sidebar != "" ? $val_link_ads_sidebar : ""; ?>">
    <?php
}
function display_cta_ads_sidebar(){
    ?>
        <input type="text" name="show_cta_ads_sidebar" id="show_cta_ads_sidebar" value="<?= get_option('show_cta_ads_sidebar'); ?>">
    <?php
}
function display_onoff_ads_sidebar(){
    ?>
        <style>.switch{position:relative;display:inline-block;width:50px;height:24px}.switch input{opacity:0;width:0;height:0}.slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:green;-webkit-transition:.4s;transition:.4s}.slider:before{position:absolute;content:"";height:16px;width:16px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider{background-color:#999}input:focus+.slider{box-shadow:0 0 1px #2196f3}input:checked+.slider:before{-webkit-transform:translateX(26px);-ms-transform:translateX(26px);transform:translateX(26px)}.slider.round{border-radius:34px}.slider.round:before{border-radius:50%}</style>
        <label class="switch">
            <input type="checkbox" name="show_onoff_ads_sidebar" id="show_onoff_ads_sidebar" <?= get_option('show_onoff_ads_sidebar') == "on" ? "checked" : "" ?>>
            <span class="slider round"></span>
        </label>
    <?php
}
//fields para o ads sidebar ===================================================


function display_fields_ads_footer(){
    add_settings_section("section_ads_footer", "", "display_option_ads_footer", "options_ads");

    add_settings_field("show_img_ads_footer", "Imagem Ads", "display_img_ads_footer", "options_ads", "section_ads_footer");
    add_settings_field("show_title_ads_footer", "Title Ads", "display_title_ads_footer", "options_ads", "section_ads_footer");
    add_settings_field("show_text_ads_footer", "Texto Ads", "display_text_ads_footer", "options_ads", "section_ads_footer");
    add_settings_field("show_link_ads_footer", "Link Ads", "display_link_ads_footer", "options_ads", "section_ads_footer");
    add_settings_field("show_cta_ads_footer", "CTA Ads", "display_cta_ads_footer", "options_ads", "section_ads_footer");
    add_settings_field("show_onoff_ads_footer", "ON/OFF Ads", "display_onoff_ads_footer", "options_ads", "section_ads_footer");

    register_setting("ads_section", "show_img_ads_footer");
    register_setting("ads_section", "show_title_ads_footer");
    register_setting("ads_section", "show_text_ads_footer");
    register_setting("ads_section", "show_link_ads_footer");
    register_setting("ads_section", "show_cta_ads_footer");
    register_setting("ads_section", "show_onoff_ads_footer");
}
add_action("admin_init", "display_fields_ads_footer");

function display_option_ads_footer(){
    ?>
        <hr>
        <h2>Anúncio Footer</h2>
    <?php
}
function display_img_ads_footer(){
    ?>
        <?php //$id_image_footer = get_option('show_img_ads_footer'); ?>
        <!-- 
        <img style="max-width: 100px" src="<?php //wp_get_attachment_image_url( $id_image_footer, 'normal' ); ?>" alt="" srcset=""> -->
    <?php
    if ( isset( $_POST['submit_image_selector_2'] ) && isset( $_POST['show_img_ads_footer'] ) ) :
        update_option( 'media_selector_attachment_id', absint( $_POST['show_img_ads_footer'] ) );
    endif;
    wp_enqueue_media();
    ?><form method='post'>
        
        <div class='image-preview-wrapper'>
            <img style="max-width: 100px" id='image-preview2' src='<?php echo wp_get_attachment_url( get_option( 'show_img_ads_footer' ) ); ?>' width='200'>
        </div>
        
        <input id="upload_image_button3" type="button" class="button" value="<?php _e( 'Atualizar imagem' ); ?>" />
        <input type='hidden' name='show_img_ads_footer' id='show_img_ads_footer' value='<?php echo get_option( 'show_img_ads_footer' ); ?>'>
        <!-- 
        <input type="submit" name="submit_image_selector_2" value="Salvar" class="button-primary">
         -->
    </form>
    
<?php


$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
    ?><script type='text/javascript'>
        jQuery( document ).ready( function( $ ) {
            // Uploading files
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
            var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
            jQuery('#upload_image_button3').on('click', function( event ){
                event.preventDefault();
                // If the media frame already exists, reopen it.
                
                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Selecione a imagem',
                    button: {
                        text: 'Usar imagem',
                    },
                    multiple: false // Set to true to allow multiple files to be selected
                });
                // When an image is selected, run a callback.
                file_frame.on( 'select', function() {
                    // We set multiple to false so only get one image from the uploader
                    attachment = file_frame.state().get('selection').first().toJSON();
                    // Do something with attachment.id and/or attachment.url here
                    $( '#image-preview2' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                    $( '#show_img_ads_footer' ).val( attachment.id );
                    // Restore the main post ID
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
                    // Finally, open the modal
                    file_frame.open();
            });
            // Restore the main ID when the add media button is pressed
            jQuery( 'a.add_media' ).on( 'click', function() {
                wp.media.model.settings.post.id = wp_media_post_id;
            });
        });
    </script>
    
    <?php
}
function display_title_ads_footer(){
    ?>
        <input type="text" name="show_title_ads_footer" id="show_title_ads_footer" value="<?= get_option('show_title_ads_footer'); ?>">
    <?php
}
function display_text_ads_footer(){
    ?>
        <textarea name="show_text_ads_footer" id="show_text_ads_footer">
            <?= get_option('show_text_ads_footer'); ?>
        </textarea>
        <script src="<?= get_template_directory_uri(); ?>/assets/js/jquery-3.5.1.min.js"></script>
        <link href="<?= get_template_directory_uri(); ?>/assets/css/summernote-lite.min.css" rel="stylesheet">
        <script src="<?= get_template_directory_uri(); ?>/assets/js/summernote-lite.min.js"></script>
        <script>
        $('#show_text_ads_sidebar').summernote({
            placeholder: 'Digite o conteúdo do Anúncio',
            tabsize: 2,
            height: 120,
            width: 450,
            toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview', 'help']]
            ]
        });
        $('#show_text_ads_footer').summernote({
            placeholder: 'Digite o conteúdo do Anúncio',
            tabsize: 2,
            height: 120,
            width: 450,
            toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview', 'help']]
            ]
        });
        </script>
    <?php
}
function display_link_ads_footer(){
    ?>
        <input type="url" name="show_link_ads_footer" id="show_link_ads_footer" value="<?= get_option('show_link_ads_footer'); ?>">
    <?php
}
function display_cta_ads_footer(){
    ?>
        <input type="text" name="show_cta_ads_footer" id="show_cta_ads_footer" value="<?= get_option('show_cta_ads_footer'); ?>">
    <?php
}
function display_onoff_ads_footer(){
    ?>
        <style>.switch{position:relative;display:inline-block;width:50px;height:24px}.switch input{opacity:0;width:0;height:0}.slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:green;-webkit-transition:.4s;transition:.4s}.slider:before{position:absolute;content:"";height:16px;width:16px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider{background-color:#999}input:focus+.slider{box-shadow:0 0 1px #2196f3}input:checked+.slider:before{-webkit-transform:translateX(26px);-ms-transform:translateX(26px);transform:translateX(26px)}.slider.round{border-radius:34px}.slider.round:before{border-radius:50%}</style>
        <label class="switch">
            <input type="checkbox" name="show_onoff_ads_footer" id="show_onoff_ads_footer" <?= get_option('show_onoff_ads_footer') == "on" ? "checked" : "" ?>>
            <span class="slider round"></span>
        </label>
    <?php
}

function display_fields_rodape(){
    add_settings_section("section_rodape", "", "display_option_rodape_social", "options_rodape");

    add_settings_field("show_rodape_instagram", "Instagram", "display_rodape_instagram", "options_rodape", "section_rodape");
    add_settings_field("show_rodape_facebook", "facebook", "display_rodape_facebook", "options_rodape", "section_rodape");
    

    register_setting("ads_section", "show_rodape_instagram");
    register_setting("ads_section", "show_rodape_facebook");
}
add_action("admin_init", "display_fields_rodape");

function display_option_rodape_social(){
    ?>
        <h2>Redes sociais</h2>
    <?php
}
function display_rodape_instagram(){
    ?>
        <input type="url" name="show_rodape_instagram" id="show_rodape_instagram" value="<?= get_option('show_rodape_instagram'); ?>">
    <?php
}
function display_rodape_facebook(){
    ?>
        <input type="url" name="show_rodape_facebook" id="show_rodape_facebook" value="<?= get_option('show_rodape_facebook'); ?>">
    <?php
}

//display links
function display_link_conta(){
    ?>
        <input type="url" name="link_acesse_conta" id="link_acesse_conta" placeholder="https..." value="<?= get_option('link_acesse_conta'); ?>">
    <?php
}
function display_link_visite_site(){
    ?>
        <input type="url" name="link_visite_site" id="link_visite_site" placeholder="https..." value="">
    <?php
}


//display inputs slider posts
function display_slide_post(){
    ?>
    
        <select name="show_slide_post" id="show_slide_post">
            <?php 
                $option_slide_post = get_option('show_slide_post');
                switch($option_slide_post):
                    case "lastPost":
                        ?>
                        <option value="lastPost">Últimos posts</option>
                        <option value="category">Categoria</option>
                        <option value="keyword">Palavra-chave</option>
                        <option value="moreread">Mais lidos</option>
                        <?php
                    break;
                    case "category":
                        ?>
                            <option value="category">Categoria</option>
                            <option value="keyword">Palavra-chave</option>
                            <option value="moreread">Mais lidos</option>
                            <option value="lastPost">Últimos posts</option>
                        <?php
                    break;
                    case "keyword":
                        ?>
                            <option value="keyword">Palavra-chave</option>
                            <option value="moreread">Mais lidos</option>
                            <option value="lastPost">Últimos posts</option>
                            <option value="category">Categoria</option>
                        <?php
                    break;
                    case "moreread":
                        ?>
                            <option value="moreread">Mais lidos</option>
                            <option value="lastPost">Últimos posts</option>
                            <option value="category">Categoria</option>
                            <option value="keyword">Palavra-chave</option>
                        <?php
                    break;
                    default:
                        ?>
                        <option value="lastPost">Últimos posts</option>
                        <option value="category">Categoria</option>
                        <option value="keyword">Palavra-chave</option>
                        <option value="moreread">Mais lidos</option>
                        <?php
                endswitch;
            ?>
        
        </select>
    <?php
}

function display_slide_post_category(){
    $option_slide_post2 = get_option('show_slide_post');
    $option_category = get_option('show_slide_post_category');
    ?>
        <select name="show_slide_post_category" id="show_slide_post_category" style="display:<?= $option_slide_post2 == "category" ? "display" : "none" ?>">
            <?php $name_term = get_nameterm_by_slugterm($option_category); ?>
            <option value="<?= $option_category ?>"><?= $name_term; ?></option>
            <?php $term_id = get_idterm_by_slugterm($option_category); ?>
            <?php
                $terms = get_terms([
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                    'exclude' => $term_id
                ]);
                foreach($terms as $term){
                    echo "<option value='".$term->slug."'>".$term->name. "</option>";      
                }  
            ?>
        </select>
    <?php
}  
function display_slide_post_keyword(){
    $option_slide_post3 = get_option('show_slide_post');
    $option_keyword = get_option('show_slide_post_keyword');
    ?>
        <input type="text" name="show_slide_post_keyword" id="show_slide_post_keyword" style="display: <?= $option_slide_post3 == "keyword" ? "display" : "none" ?>" placeholder="keyword..." value="<?= $option_keyword; ?>">

        <script>
            document.getElementById("show_slide_post").addEventListener("change", function(){
                var val_type = document.getElementById("show_slide_post").value;

                switch(val_type){
                    case "category":
                        document.getElementById("show_slide_post_category").style.display = "inline-block";
                        document.getElementById("show_slide_post_keyword").style.display = "none";
                    break;
                    case "keyword":
                        document.getElementById("show_slide_post_keyword").style.display = "inline-block";
                        document.getElementById("show_slide_post_category").style.display = "none";
                    break;
                    default:
                        document.getElementById("show_slide_post_keyword").style.display = "none";
                        document.getElementById("show_slide_post_category").style.display = "none";
                }
            })
        </script>
        
    <?php
}
function display_pina_slide_post(){
    $val_select = get_option("show_pina_slide_post");
    ?>
        <select name="show_pina_slide_post" id="show_pina_slide_post">
            <?php if($val_select == "yes"): ?>
                <option value="yes">SIM</option>
                <option value="no">NÃO</option>
            <?php else: ?>
                <option value="no">NÃO</option>
                <option value="yes">SIM</option>
            <?php endif; ?>
        </select>
    <?php
}
function display_lista_posts_slide(){
    $val_select2 = get_option("show_pina_slide_post");
    $val_list_post2 = get_option("show_lista_posts_slide");
    ?>
        
        Todos os Posts <select class="select-search-input" name="show_lista_posts_slide" id="show_lista_posts_slide" <?= $val_select2 == "yes" ? "enable" : "disabled" ?>>
            <?php
                $args_post_slide = [
                    'post_type' => 'post',
                    'order' => 'DESC',
                    'posts_per_page' => -1
                ];
                $result_post_slide = new WP_query($args_post_slide);
            if($result_post_slide->have_posts()): while($result_post_slide->have_posts()): $result_post_slide->the_post(); ?>
                <option value="<?= the_title(); ?>" <?= $val_list_post2 == get_the_title() ? "selected" : ""; ?>><?= the_title(); ?></option>
            <?php endwhile; endif;  wp_reset_query(); wp_reset_postdata();?>
        </select>
        
        <script>
            document.getElementById("show_pina_slide_post").addEventListener("change", function(){
                var val_select = document.getElementById("show_pina_slide_post");
                var list_posts = document.getElementById("show_lista_posts_slide");
                if(val_select.value == "yes"){
                    list_posts.removeAttribute('disabled', '');
                    list_posts.setAttribute('enable','');
                }else{
                    list_posts.removeAttribute('enable', '');
                    list_posts.setAttribute('disabled', '');
                    
                }
            });
        </script>
    <?php
}
function display_slide_post_count(){
    ?>
        <input type="number" style="width: 64px" name="show_slide_post_count" id="show_slide_post_count" value="<?= get_option('show_slide_post_count') != "" ? get_option('show_slide_post_count') : "4"; ?>"> Padrão é 4
        <?php echo "<p><strong>Método de listagem atual: </strong>";
            $slide_post = get_option('show_slide_post');

            switch($slide_post):
                case "lastPost":
                    echo "<span style='color: orange'>Últimos posts</span>";
                break;
                case "category":
                    $cat_slide = get_option("show_slide_post_category");
                    $args_cat = [
                        'taxonomy' => 'category',
                        'hide_empty' => false,
                        'slug' => $cat_slide
                    ];
                    $categoria_slide = get_terms($args_cat);
                    echo "<span style='color: orange'>Categoria: </span><span style='color: green'>".$categoria_slide[0]->name."</span>";
                break;
                case "keyword":
                    echo "<span style='color: orange'>Palavra-chave: </span><span style='color: green'>".get_option("show_slide_post_keyword")."</span>";
                break;
                case "moreread":
                    echo "<span style='color: orange'>Mais lidos</span>";
                break;
                default:
                    echo "<span style='color: orange'>Mais lidos</span>";
            endswitch;

        ?>
    <?php
}
//display inputs slider posts ==================================================


//display inputs sidebar posts =================================================
function display_sidebar_post(){
    ?>
        
        <select name="show_sidebar_post" id="show_sidebar_post">
        <?php 
                $option_sidebar_post = get_option('show_sidebar_post');
                switch($option_sidebar_post):
                    case "lastPost":
                        ?>
                            <option value="lastPost">Últimos posts</option>
                            <option value="category">Categoria</option>
                            <option value="keyword">Palavra-chave</option>
                            <option value="moreread">Mais lidos</option>
                        <?php
                    break;
                    case "category":
                        ?>
                            <option value="category">Categoria</option>
                            <option value="keyword">Palavra-chave</option>
                            <option value="moreread">Mais lidos</option>
                            <option value="lastPost">Últimos posts</option>
                        <?php
                    break;
                    case "keyword":
                        ?>
                            <option value="keyword">Palavra-chave</option>
                            <option value="moreread">Mais lidos</option>
                            <option value="lastPost">Últimos posts</option>
                            <option value="category">Categoria</option>
                        <?php
                    break;
                    case "moreread":
                        ?>
                            <option value="moreread">Mais lidos</option>
                            <option value="lastPost">Últimos posts</option>
                            <option value="category">Categoria</option>
                            <option value="keyword">Palavra-chave</option>
                        <?php
                    break;
                    default:
                        ?>
                        <option value="lastPost">Últimos posts</option>
                        <option value="category">Categoria</option>
                        <option value="keyword">Palavra-chave</option>
                        <option value="moreread">Mais lidos</option>
                        <?php
                endswitch;
            ?>
        </select>

        
    <?php
}

function display_sidebar_post_category(){
    $option_sidebar_post = get_option('show_sidebar_post');
    $option_category = get_option('show_sidebar_post_category');
    ?>
        <select name="show_sidebar_post_category" id="show_sidebar_post_category" style="display:<?= $option_sidebar_post == "category" ? "display" : "none" ?>">
        <?php $name_term = get_nameterm_by_slugterm($option_category); ?>
            <option value="<?= $option_category ?>"><?= $name_term; ?></option>
            <?php $term_id = get_idterm_by_slugterm($option_category); ?>
            <?php
                $terms = get_terms([
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                    'exclude' => $term_id
                ]);
                foreach($terms as $term){
                    echo "<option value='".$term->slug."'>".$term->name. "</option>";      
                }  
            ?>
        </select> 
    <?php
}

function display_sidebar_post_keyword(){
    $option_sidebar_post3 = get_option('show_sidebar_post');
    $option_keyword = get_option('show_sidebar_post_keyword');
    ?>
        <input type="text" name="show_sidebar_post_keyword" id="show_sidebar_post_keyword" style="display: <?= $option_sidebar_post3 == "keyword" ? "display" : "none" ?>" placeholder="keyword..." value="<?= $option_keyword; ?>" placeholder="keyword...">
        <script>
            document.getElementById("show_sidebar_post").addEventListener("change", function(){
                var val_type = document.getElementById("show_sidebar_post").value;

                switch(val_type){
                    case "category":
                        document.getElementById("show_sidebar_post_category").style.display = "inline-block";
                        document.getElementById("show_sidebar_post_keyword").style.display = "none";
                    break;
                    case "keyword":
                        document.getElementById("show_sidebar_post_keyword").style.display = "inline-block";
                        document.getElementById("show_sidebar_post_category").style.display = "none";
                    break;
                    default:
                        document.getElementById("show_sidebar_post_keyword").style.display = "none";
                        document.getElementById("show_sidebar_post_category").style.display = "none";
                }
            })
        </script>
        
    <?php
}
function display_pina_sidebar_post(){
    $val_pina_sidebar = get_option("show_pina_sidebar_post");
    ?>
    
        <select name="show_pina_sidebar_post" id="show_pina_sidebar_post">
            <option value="no" <?= $val_pina_sidebar == "no" ? "selected" : "" ?>>NÃO</option>
            <option value="yes" <?= $val_pina_sidebar == "yes" ? "selected" : "" ?>>SIM</option>
        </select>
    <?php
}
function display_lista_posts_sidebar(){
    $val_pina_sidebar2 = get_option("show_pina_sidebar_post");
    $val_list_post_sidebar = get_option("show_lista_posts_sidebar");
    ?>
        
        Todos os Posts <select class="select-search-input" name="show_lista_posts_sidebar" id="show_lista_posts_sidebar" <?= $val_pina_sidebar2 == "yes" ? "enable" : "disabled" ?>>
            <?php
                $args_post_slide = [
                    'post_type' => 'post',
                    'order' => 'DESC',
                    'posts_per_page' => -1
                ];
                $result_post_slide = new WP_query($args_post_slide);
            if($result_post_slide->have_posts()): while($result_post_slide->have_posts()): $result_post_slide->the_post(); ?>
                <option value="<?= the_title(); ?>" <?= $val_list_post_sidebar == get_the_title() ? "selected" : "" ?>><?= the_title(); ?></option>
            <?php endwhile; endif; wp_reset_query(); wp_reset_postdata(); ?>
        </select>
        <script src="<?= get_template_directory_uri(); ?>/assets/js/jquery-3.5.1.min.js"></script>
        <link href="<?= get_template_directory_uri(); ?>/assets/css/select2.min.css" rel="stylesheet" />
        <script src="<?= get_template_directory_uri(); ?>/assets/js/select2.min.js"></script>
        <script>
            document.getElementById("show_pina_sidebar_post").addEventListener("change", function(){
                var val_select = document.getElementById("show_pina_sidebar_post");
                var list_posts = document.getElementById("show_lista_posts_sidebar");
                if(val_select.value == "yes"){
                    list_posts.removeAttribute('disabled', '');
                    list_posts.setAttribute('enable','');
                }else{
                    list_posts.removeAttribute('enable', '');
                    list_posts.setAttribute('disabled', '');
                    
                }
            });
            
            $(document).ready(function() {
                $('.select-search-input').select2();
            });
        </script>
    <?php
}
function display_sidebar_post_count(){
    ?>
        <input type="number" style="width: 64px" name="show_sidebar_post_count" id="show_sidebar_post_count" value="<?= get_option('show_sidebar_post_count') != "" ? get_option('show_sidebar_post_count') : "5"; ?>"> Padrão é 5
        <?php echo "<p><strong>Método de listagem atual: </strong>";
            $slide_post = get_option('show_sidebar_post');

            switch($slide_post):
                case "lastPost":
                    echo "<span style='color: orange'>Últimos posts</span>";
                break;
                case "category":
                    $cat_slide = get_option("show_sidebar_post_category");
                    $args_cat = [
                        'taxonomy' => 'category',
                        'hide_empty' => false,
                        'slug' => $cat_slide
                    ];
                    $categoria_slide = get_terms($args_cat);
                    echo "<span style='color: orange'>Categoria: </span><span style='color: green'>".$categoria_slide[0]->name."</span>";
                break;
                case "keyword":
                    echo "<span style='color: orange'>Palavra-chave: </span><span style='color: green'>".get_option("show_sidebar_post_keyword")."</span>";
                break;
                case "moreread":
                    echo "<span style='color: orange'>Mais lidos</span>";
                break;
                default:
                    echo "<span style='color: orange'>Mais lidos</span>";
            endswitch;
  
        ?>
    <?php
}
//display inputs sidebar posts


function display_header_options_content(){
    echo "Aqui ficam as configurações gerais do site";
}


?>