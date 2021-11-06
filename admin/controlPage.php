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
                settings_fields("posts_section");
                
                // all the add_settings_field callbacks is displayed here
                do_settings_sections("options_ads");
            
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
        <h2>Configuração do links e popup</h2>
    <?php
}
add_action("admin_init", "display_fields_links_acesse_conta");


function display_fields_popup(){
    add_settings_section("popup_section", "", "display_popup", "theme-options");

    add_settings_field("popup_link", "Link da Popup", "display_link_popup", "theme-options", "popup_section");
    add_settings_field("popup_aviso_link", "Texto do link da Popup", "display_link_aviso_popup", "theme-options", "popup_section");
    add_settings_field("popup_aviso_label", "Texto do Label da Popup", "display_popup_aviso_label", "theme-options", "popup_section");
    add_settings_field("popup_icon_attachment_id", "ícone da Popup", "display_icon_popup", "theme-options", "popup_section");
    add_settings_field("popup_cookie", "Tempo de exibição", "display_cookie_popup", "theme-options", "popup_section");
    add_settings_field("popup_show", "Controle de exibição", "display_show_popup", "theme-options", "popup_section");

    register_setting("links_popup_section", "popup_link");
    register_setting("links_popup_section", "popup_aviso_link");
    register_setting("links_popup_section", "popup_aviso_label");
    register_setting("links_popup_section", "popup_icon_attachment_id");
    register_setting("links_popup_section", "popup_tempo");
    register_setting("links_popup_section", "popup_show");
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

        <script>
            wp.
        </script>
    <?php
}
function display_icon_popup(){
    ?>
        <!-- 
        <input type="file" name="popup_icon" id="popup_icon">
        <p><?= get_option('popup_icon'); ?></p> -->
        <?php $id_image = get_option('popup_icon_attachment_id'); ?>
        <img src="<?= wp_get_attachment_image_url( $id_image, 'thumbnail' ); ?>" alt="" srcset="">
         
        
        <?php
if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['popup_icon_attachment_id'] ) ) :
        update_option( 'media_selector_attachment_id', absint( $_POST['popup_icon_attachment_id'] ) );
    endif;
    wp_enqueue_media();
    ?><form method='post'>
        <div class='image-preview-wrapper'>
            <img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' width='200'>
        </div>
        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
        <input type='hidden' name='popup_icon_attachment_id' id='popup_icon_attachment_id' value='<?php echo get_option( 'popup_icon_attachment_id' ); ?>'>
        <input type="submit" name="submit_image_selector" value="Save" class="button-primary">
    </form>
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
                /*
                if ( file_frame ) {
                    // Set the post ID to what we want
                    file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                    // Open frame
                    file_frame.open();
                    return;
                } else {
                    // Set the wp.media post id so the uploader grabs the ID we want when initialised
                    wp.media.model.settings.post.id = set_to_post_id;
                }
                */
                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Selecione a imagem',
                    button: {
                        text: 'Use this image',
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


/*
function display_options()
{

    //config setting API formulário de contato
    add_settings_section("header_section", "", "display_header_options_content", "theme-options");
    
    add_settings_field("link_acesse_conta", "Link de 'Acess sua conta'", "display_link_conta", "theme-options", "header_section");
    add_settings_field("link_visite_site", "Link de 'Visite nosso site'", "display_link_visite_site", "theme-options", "header_section");



    //section posts
    //add_settings_section("posts_section", "", "display_posts_options_content", "options_list_posts");
    //add_settings_section("posts_section_sidebar","", "display_posts_options_content_sidebar", "options_list_posts");
    //config listagem posts sliders
    //add_settings_field("show_slide_post", "Forma de listagem dos slider post", "display_slide_post", "options_list_posts", //"posts_section");
    //add_settings_field("show_slide_post_category", "", "display_slide_post_category", "options_list_posts", "posts_section");
    //add_settings_field("show_slide_post_keyword", "", "display_slide_post_keyword", "options_list_posts", "posts_section");
    //add_settings_field("show_pina_slide_post", "Fixar primeiro post do slide", "display_pina_slide_post", "options_list_posts", //"posts_section");
    //add_settings_field("show_lista_posts_slide", "", "display_lista_posts_slide", "options_list_posts", "posts_section");//add_settings_field("show_slide_post_count", "Contagem de Posts", "display_slide_post_count", "options_list_posts", "posts_section");
    //config listagem posts sliders

    //config listagem posts sidedar
    //add_settings_field("show_sidebar_post", "Forma de listagem dos posts laterais (Artigos mais lidos)", "display_sidebar_post", //"options_list_posts", "posts_section_sidebar");
    //add_settings_field("show_sidebar_post_category", "", "display_sidebar_post_category", "options_list_posts", //"posts_section_sidebar");
    //add_settings_field("show_sidebar_post_keyword", "", "display_sidebar_post_keyword", "options_list_posts", //"posts_section_sidebar");
    //add_settings_field("show_pina_sidebar_post", "Fixar primeiro Post no sidebar", "display_pina_sidebar_post", //"options_list_posts", "posts_section_sidebar");
    //add_settings_field("show_lista_posts_sidebar", "", "display_lista_posts_sidebar", "options_list_posts", //"posts_section_sidebar");
    //add_settings_field("show_sidebar_post_count", "Contagem de Posts", "display_sidebar_post_count", "options_list_posts", //"posts_section_sidebar");
    //config listagem posts sidedar
    //section posts


   
    register_setting("header_section", "link_acesse_conta");
    register_setting("header_section", "link_visite_site");
    
    //register fields post sliders
    //register_setting("posts_section", "show_slide_post");
    //register_setting("posts_section", "show_slide_post_count");
    //register_setting("posts_section", "show_slide_post_category");
    //register_setting("posts_section", "show_slide_post_keyword");
    //register_setting("posts_section", "show_pina_slide_post");
    //register_setting("posts_section", "show_lista_posts_slide");
    //register fields post sliders

    //register fields sidebar post
    //register_setting("posts_section_sidebar", "show_sidebar_post");
    //register_setting("posts_section_sidebar", "show_sidebar_post_count");
    //register_setting("posts_section_sidebar", "show_sidebar_post_category");
    //register_setting("posts_section_sidebar", "show_sidebar_post_keyword");
    //register_setting("posts_section_sidebar", "show_pina_sidebar_post");
    //register_setting("posts_section_sidebar", "show_lista_posts_sidebar");
    //register fields sidebar post

}
add_action("admin_init", "display_options");
*/


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