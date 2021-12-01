<?php

function callback_options_ads_category(){
    ?>
    <div>
        <?php settings_errors(); ?>
        <h1>Configuração dos anúncios da página de categoria</h1>
        <h3>Esses anúncios são exibidos na página de categoria</h3>
        <form method="post" action="options.php">
            <?php
            
                //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                settings_fields("ads_category_section");
                
                // all the add_settings_field callbacks is displayed here
                do_settings_sections("options_ads_category");
            
                // Add the submit button to serialize the options
                submit_button();
                
            ?>         
        </form>
    </div>
    <?php
}
//fields para o ads sidebar ===================================================
function display_fields_ads_sidebar_category(){
    add_settings_section("section_ads_sidebar_category", "", "display_option_ads_sidebar", "options_ads_category");

    add_settings_field("show_img_ads_sidebar_category", "Imagem Ads", "display_img_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_title_ads_sidebar_category", "Title Ads", "display_title_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_color_title_ads_sidebar_category", "Cor do título Ads", "display_color_title_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_text_ads_sidebar_category", "Texto Ads", "display_text_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_link_ads_sidebar_category", "Link Ads", "display_link_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_cta_ads_sidebar_category", "CTA Ads", "display_cta_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_color_txt_cta_ads_sidebar_category", "Cor do texto do botão Ads", "display_color_txt_cta_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_color_cta_ads_sidebar_category", "Cor de fundo do botão CTA", "display_color_cta_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_color_ads_sidebar_category", "Cor de fundo do Banner", "display_color_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");
    add_settings_field("show_onoff_ads_sidebar_category", "ON/OFF Ads", "display_onoff_ads_sidebar_category", "options_ads_category", "section_ads_sidebar_category");

    register_setting("ads_category_section", "show_img_ads_sidebar_category");
    register_setting("ads_category_section", "show_title_ads_sidebar_category");
    register_setting("ads_category_section", "show_color_title_ads_sidebar_category");
    register_setting("ads_category_section", "show_text_ads_sidebar_category");
    register_setting("ads_category_section", "show_link_ads_sidebar_category");
    register_setting("ads_category_section", "show_cta_ads_sidebar_category");
    register_setting("ads_category_section", "show_color_txt_cta_ads_sidebar_category");
    register_setting("ads_category_section", "show_color_cta_ads_sidebar_category");
    register_setting("ads_category_section", "show_color_ads_sidebar_category");
    register_setting("ads_category_section", "show_onoff_ads_sidebar_category");
}
add_action("admin_init", "display_fields_ads_sidebar_category");

function display_option_ads_sidebar_category(){
    ?>
        <h2>Anúncio Sidebar</h2>
    <?php
}
function display_img_ads_sidebar_category(){
    ?>
    
    <?php //$id_image = get_option('show_img_ads_sidebar'); ?>
        <!-- 
        <img style="max-width: 100px" src="<?php //wp_get_attachment_image_url( $id_image, 'normal' ); ?>" alt="" srcset="">
         -->
    <?php
    if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['show_img_ads_sidebar_category'] ) ) :
        update_option( 'show_img_ads_sidebar_category', absint( $_POST['show_img_ads_sidebar_category'] ) );
    endif;
    wp_enqueue_media();
    ?>
    
        <div class='image-preview-wrapper'>
            <img style="max-width: 200px" id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'show_img_ads_sidebar_category' ) ); ?>' width='200'>
        </div> A imagem deve ter no máximo 300px de largura
         
        <input style="display: block" id="upload_image_button2" type="button" class="button" value="<?php _e( 'Atualizar imagem' ); ?>" />
        <input type='hidden' name='show_img_ads_sidebar_category' id='show_img_ads_sidebar_category' value='<?php echo get_option( 'show_img_ads_sidebar_category' ); ?>'>
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
                    $( '#show_img_ads_sidebar_category' ).val( attachment.id );
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
function display_title_ads_sidebar_category(){
    $val_title_ads_sidebar = get_option('show_title_ads_sidebar_category');
    ?>
        <input type="text" name="show_title_ads_sidebar_category" id="show_title_ads_sidebar_category" value="<?= $val_title_ads_sidebar != "" ? $val_title_ads_sidebar : ""; ?>" style="width: 400px;">
    <?php
}
function display_color_title_ads_sidebar_category(){
    $option_color_title_sidebar_category = get_option('show_color_title_ads_sidebar_category');
    ?>
        <style>
            .btn_reset_color_txt_ads_sidebar_category{
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
            .btn_reset_color_txt_ads_sidebar_category:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_title_ads_sidebar_category" id="show_color_title_ads_sidebar_category" value="<?= $option_color_title_sidebar_category != "" ? $option_color_title_sidebar_category : "#3B4157"; ?>">
        <span class="btn_reset_color_txt_ads_sidebar_category">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_txt_ads_sidebar_category").addEventListener("click", function(){
                document.getElementById("show_color_title_ads_sidebar_category").value = "#3B4157";
            });
        </script>
    <?php
}
function display_text_ads_sidebar_category(){
    ?>
        <textarea name="show_text_ads_sidebar_category" id="show_text_ads_sidebar_category">
            <?= get_option('show_text_ads_sidebar_category'); ?>
        </textarea>
        
       

    <?php
}
function display_link_ads_sidebar_category(){
    $val_link_ads_sidebar = get_option('show_link_ads_sidebar_category');
    ?>
        <input type="url" name="show_link_ads_sidebar_category" id="show_link_ads_sidebar_category" value="<?= $val_link_ads_sidebar != "" ? $val_link_ads_sidebar : ""; ?>">
    <?php
}
function display_cta_ads_sidebar_category(){
    ?>
        <input type="text" name="show_cta_ads_sidebar_category" id="show_cta_ads_sidebar_category" value="<?= get_option('show_cta_ads_sidebar_category'); ?>">
    <?php
}
function display_color_txt_cta_ads_sidebar_category(){
    $option_color_sidebar = get_option('show_color_txt_cta_ads_sidebar_category');
    ?>
        <style>
            .btn_reset_color_txt_ads_sidebar{
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
            .btn_reset_color_txt_ads_sidebar:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_txt_cta_ads_sidebar_category" id="show_color_txt_cta_ads_sidebar_category" value="<?= $option_color_sidebar != "" ? $option_color_sidebar : "#ffffff"; ?>">
        <span class="btn_reset_color_txt_ads_sidebar">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_txt_ads_sidebar").addEventListener("click", function(){
                document.getElementById("show_color_txt_cta_ads_sidebar_category").value = "#ffffff";
            });
        </script>
    <?php
}
function display_color_cta_ads_sidebar_category(){
    $option_color_sidebar = get_option('show_color_cta_ads_sidebar_category');
    ?>
        <style>
            .btn_reset_color_cta_ads_sidebar{
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
            .btn_reset_color_cta_ads_sidebar:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_cta_ads_sidebar_category" id="show_color_cta_ads_sidebar_category" value="<?= $option_color_sidebar != "" ? $option_color_sidebar : "#5B90B9"; ?>">
        <span class="btn_reset_color_cta_ads_sidebar">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_cta_ads_sidebar").addEventListener("click", function(){
                document.getElementById("show_color_cta_ads_sidebar_category").value = "#5B90B9";
            });
        </script>
    <?php
}
function display_color_ads_sidebar_category(){
    $option_color_sidebar = get_option('show_color_ads_sidebar_category');
    ?>
        <style>
            .btn_reset_color_ads_sidebar{
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
            .btn_reset_color_ads_sidebar:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_ads_sidebar_category" id="show_color_ads_sidebar_category" value="<?= $option_color_sidebar != "" ? $option_color_sidebar : "#ffffff"; ?>">
        <span class="btn_reset_color_ads_sidebar">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_ads_sidebar").addEventListener("click", function(){
                document.getElementById("show_color_ads_sidebar_category").value = "#ffffff";
            });
        </script>
    <?php
}
function display_onoff_ads_sidebar_category(){
    ?>
        <style>.switch{position:relative;display:inline-block;width:50px;height:24px}.switch input{opacity:0;width:0;height:0}.slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:green;-webkit-transition:.4s;transition:.4s}.slider:before{position:absolute;content:"";height:16px;width:16px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider{background-color:#999}input:focus+.slider{box-shadow:0 0 1px #2196f3}input:checked+.slider:before{-webkit-transform:translateX(26px);-ms-transform:translateX(26px);transform:translateX(26px)}.slider.round{border-radius:34px}.slider.round:before{border-radius:50%}</style>
        <label class="switch">
            <input type="checkbox" name="show_onoff_ads_sidebar_category" id="show_onoff_ads_sidebar_category" <?= get_option('show_onoff_ads_sidebar_category') == "on" ? "checked" : "" ?>>
            <span class="slider round"></span>
        </label>
    <?php
}
//fields para o ads sidebar ===================================================





//fields for ads footer from search page =====================================================
function display_fields_ads_footer_category(){
    add_settings_section("section_ads_footer_category", "", "display_option_ads_footer_category", "options_ads_category");

    add_settings_field("show_img_ads_footer_category", "Imagem Ads", "display_img_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_title_ads_footer_category", "Title Ads", "display_title_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_color_title_ads_footer_category", "Cor do título Ads", "display_color_title_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_text_ads_footer_category", "Texto Ads", "display_text_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_link_ads_footer_category", "Link Ads", "display_link_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_cta_ads_footer_category", "CTA Ads", "display_cta_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_color_txt_cta_ads_footer", "Cor do texto do botão Ads", "display_color_txt_cta_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_color_cta_ads_footer_category", "Cor de fundo do botão CTA", "display_color_cta_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_color_ads_footer_category", "Cor de fundo do Banner", "display_color_ads_footer_category", "options_ads_category", "section_ads_footer_category");
    add_settings_field("show_onoff_ads_footer_category", "ON/OFF Ads", "display_onoff_ads_footer_category", "options_ads_category", "section_ads_footer_category");

    register_setting("ads_category_section", "show_img_ads_footer_category");
    register_setting("ads_category_section", "show_title_ads_footer_category");
    register_setting("ads_category_section", "show_color_title_ads_footer_category");
    register_setting("ads_category_section", "show_text_ads_footer_category");
    register_setting("ads_category_section", "show_link_ads_footer_category");
    register_setting("ads_category_section", "show_cta_ads_footer_category");
    register_setting("ads_category_section", "show_color_txt_cta_ads_footer_category");
    register_setting("ads_category_section", "show_color_cta_ads_footer_category");
    register_setting("ads_category_section", "show_color_ads_footer_category");
    register_setting("ads_category_section", "show_onoff_ads_footer");
}
add_action("admin_init", "display_fields_ads_footer_category");

function display_option_ads_footer_category(){
    ?>
        <hr>
        <h2>Anúncio Footer</h2>
    <?php
}

function display_img_ads_footer_category(){
    ?>
        <?php //$id_image_footer = get_option('show_img_ads_footer'); ?>
        <!-- 
        <img style="max-width: 100px" src="<?php //wp_get_attachment_image_url( $id_image_footer, 'normal' ); ?>" alt="" srcset=""> -->
    <?php
    if ( isset( $_POST['submit_image_selector_2'] ) && isset( $_POST['show_img_ads_footer_category'] ) ) :
        update_option( 'show_img_ads_footer_category', absint( $_POST['show_img_ads_footer_category'] ) );
    endif;
    wp_enqueue_media();
    ?><form method='post'>
        
        <div class='image-preview-wrapper'>
            <img style="max-width: 100px" id='image-preview2' src='<?php echo wp_get_attachment_url( get_option( 'show_img_ads_footer_category' ) ); ?>' width='200'>
        </div> A imagem deve ter no máximo 60px de largura <br>
        
        <input id="upload_image_button3" type="button" class="button" value="<?php _e( 'Atualizar imagem' ); ?>" />
        <input type='hidden' name='show_img_ads_footer_category' id='show_img_ads_footer_category' value='<?php echo get_option( 'show_img_ads_footer_category' ); ?>'>
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
                    $( '#show_img_ads_footer_category' ).val( attachment.id );
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
function display_title_ads_footer_category(){
    ?>
        <input type="text" name="show_title_ads_footer_category" id="show_title_ads_footer_category" value="<?= get_option('show_title_ads_footer_category'); ?>">
    <?php
}
function display_color_title_ads_footer_category(){
    $option_color_title_footer_category = get_option('show_color_title_ads_footer_category');
    ?>
        <style>
            .btn_reset_color_txt_ads_footer_category{
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
            .btn_reset_color_txt_ads_footer_category:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_title_ads_footer_category" id="show_color_title_ads_footer_category" value="<?= $option_color_title_footer_category != "" ? $option_color_title_footer_category : "#ffffff"; ?>">
        <span class="btn_reset_color_txt_ads_footer_category">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_txt_ads_footer_category").addEventListener("click", function(){
                document.getElementById("show_color_title_ads_footer_category").value = "#ffffff";
            });
        </script>
    <?php
}
function display_color_txt_cta_ads_footer_category(){
    $option_color_footer = get_option('show_color_txt_cta_ads_footer_category');
    ?>
        <style>
            .btn_reset_color_txt_ads_footer{
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
            .btn_reset_color_txt_ads_footer:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_txt_cta_ads_footer_category" id="show_color_txt_cta_ads_footer_category" value="<?= $option_color_footer != "" ? $option_color_footer : "#3B4157"; ?>">
        <span class="btn_reset_color_txt_ads_footer">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_txt_ads_footer").addEventListener("click", function(){
                document.getElementById("show_color_txt_cta_ads_footer_category").value = "#3B4157";
            });
        </script>
    <?php
}
function display_color_cta_ads_footer_category(){
    $option_color_footer = get_option('show_color_cta_ads_footer_category');
    ?>
        <style>
            .btn_reset_color_cta_ads_footer{
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
            .btn_reset_color_cta_ads_footer:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_cta_ads_footer_category" id="show_color_cta_ads_footer_category" value="<?= $option_color_footer != "" ? $option_color_footer : "#ffffff"; ?>">
        <span class="btn_reset_color_cta_ads_footer">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_cta_ads_footer").addEventListener("click", function(){
                document.getElementById("show_color_cta_ads_footer_category").value = "#ffffff";
            });
        </script>
    <?php
}
function display_color_ads_footer_category(){
    $option_color_footer = get_option('show_color_ads_footer_category');
    ?>
        <style>
            .btn_reset_color_ads_footer{
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
            .btn_reset_color_ads_footer:hover{
                cursor: pointer;
            }
        </style>
        <input type="color" name="show_color_ads_footer_category" id="show_color_ads_footer_category" value="<?= $option_color_footer != "" ? $option_color_footer : "#3B4157"; ?>">
        <span class="btn_reset_color_ads_footer">&#8635;</span>
        <script>
            document.querySelector(".btn_reset_color_ads_footer").addEventListener("click", function(){
                document.getElementById("show_color_ads_footer_category").value = "#3B4157";
            });
        </script>
    <?php
}
function display_text_ads_footer_category(){
    ?>
        <textarea name="show_text_ads_footer_category" id="show_text_ads_footer_category">
            <?= get_option('show_text_ads_footer_category'); ?>
        </textarea>
        <script src="<?= get_template_directory_uri(); ?>/assets/js/jquery-3.5.1.min.js"></script>
        <link href="<?= get_template_directory_uri(); ?>/assets/css/summernote-lite.min.css" rel="stylesheet">
        <script src="<?= get_template_directory_uri(); ?>/assets/js/summernote-lite.min.js"></script>
        <script>
        $('#show_text_ads_sidebar_category').summernote({
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
        $('#show_text_ads_footer_category').summernote({
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
function display_link_ads_footer_category(){
    ?>
        <input type="url" name="show_link_ads_footer_category" id="show_link_ads_footer_category" value="<?= get_option('show_link_ads_footer_category'); ?>">
    <?php
}
function display_cta_ads_footer_category(){
    ?>
        <input type="text" name="show_cta_ads_footer_category" id="show_cta_ads_footer_category" value="<?= get_option('show_cta_ads_footer_category'); ?>">
    <?php
}
function display_onoff_ads_footer_category(){
    ?>
        <style>.switch{position:relative;display:inline-block;width:50px;height:24px}.switch input{opacity:0;width:0;height:0}.slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:green;-webkit-transition:.4s;transition:.4s}.slider:before{position:absolute;content:"";height:16px;width:16px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider{background-color:#999}input:focus+.slider{box-shadow:0 0 1px #2196f3}input:checked+.slider:before{-webkit-transform:translateX(26px);-ms-transform:translateX(26px);transform:translateX(26px)}.slider.round{border-radius:34px}.slider.round:before{border-radius:50%}</style>
        <label class="switch">
            <input type="checkbox" name="show_onoff_ads_footer_category" id="show_onoff_ads_footer_category" <?= get_option('show_onoff_ads_footer_category') == "on" ? "checked" : "" ?>>
            <span class="slider round"></span>
        </label>
    <?php
}
?>