<?php

function add_new_menu_items(){

    //Add um item de menu. This is a top level menu item i.e., this menu item can have sub menus
    add_menu_page(
        "Configuração Geral", //Required. esse é o título da página do menu
        "Configuração de links", //Required. Texto do menu
        "manage_options", //Required. The required capability of users to access this menu item.
        "theme-options", //Required. identificador único desse menu
        "theme_options_page", //Optional. This callback outputs the content of the page associated with this menu item.
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
        "options_apresentacao", //Required. A unique identifier to the sub menu item.
        "apresentacao_options_page", //Optional. This callback outputs the content of the page associated //with this menu item.
        "" //Optional. The URL of the menu item icon
    );

}
function theme_options_page(){
    ?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"></div><!-- run the settings_errors() function here. -->
        <?php settings_errors(); ?>
        <h1>Configurações dos links</h1>
        <form method="post" action="options.php">
            <?php
            
                //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                settings_fields("header_section");
                
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

add_action("admin_menu", "add_new_menu_items");

function display_options()
{
    

    //config setting API formulário de contato
    add_settings_section("header_section", "", "display_header_options_content", "theme-options");
    
    add_settings_field("link_acesse_conta", "Link de 'Acess sua conta'", "display_link_conta", "theme-options", "header_section");
    add_settings_field("link_visite_site", "Link de 'Visite nosso site'", "display_link_visite_site", "theme-options", "header_section");



    //section posts
    add_settings_section("posts_section", "", "display_posts_options_content", "options_list_posts");
    //config listagem posts sliders
    add_settings_field("show_slide_post", "<span style='display: flex; padding: 5px; border: 1px solid #999; border-radius: 10px'>Forma de listagem dos slider post</span>", "display_slide_post", "options_list_posts", "posts_section");
    add_settings_field("show_slide_post_category", "", "display_slide_post_category", "options_list_posts", "posts_section");
    add_settings_field("show_slide_post_keyword", "", "display_slide_post_keyword", "options_list_posts", "posts_section");
    add_settings_field("show_pina_slide_post", "Fixar primeiro post do slide", "display_pina_slide_post", "options_list_posts", "posts_section");
    add_settings_field("show_lista_posts_slide", "", "display_lista_posts_slide", "options_list_posts", "posts_section");add_settings_field("show_slide_post_count", "Contagem de Posts", "display_slide_post_count", "options_list_posts", "posts_section");
    //config listagem posts sliders

    //config listagem posts sidedar
    add_settings_field("show_sidebar_post", "<span style='display: flex; padding: 5px; border: 1px solid #999; border-radius: 10px'>Forma de listagem dos posts laterais (Artigos mais lidos)</span>", "display_sidebar_post", "options_list_posts", "posts_section");
    add_settings_field("show_sidebar_post_category", "", "display_sidebar_post_category", "options_list_posts", "posts_section");
    add_settings_field("show_sidebar_post_keyword", "", "display_sidebar_post_keyword", "options_list_posts", "posts_section");
    add_settings_field("show_pina_sidebar_post", "Fixar primeiro Post no sidebar", "display_pina_sidebar_post", "options_list_posts", "posts_section");
    add_settings_field("show_lista_posts_sidebar", "", "display_lista_posts_sidebar", "options_list_posts", "posts_section");add_settings_field("show_sidebar_post_count", "Contagem de Posts", "display_sidebar_post_count", "options_list_posts", "posts_section");
    //config listagem posts sidedar
    //section posts


   
    register_setting("header_section", "link_acesse_conta");
    register_setting("header_section", "link_visite_site");
    
    //register fields post sliders
    register_setting("posts_section", "show_slide_post");
    register_setting("posts_section", "show_slide_post_count");
    register_setting("posts_section", "show_slide_post_category");
    register_setting("posts_section", "show_slide_post_keyword");
    register_setting("posts_section", "show_pina_slide_post");
    register_setting("posts_section", "show_lista_posts_slide");
    //register fields post sliders

    //register fields sidebar post
    register_setting("posts_section", "show_sidebar_post");
    register_setting("posts_section", "show_sidebar_post_count");
    register_setting("posts_section", "show_sidebar_post_category");
    register_setting("posts_section", "show_sidebar_post_keyword");
    register_setting("posts_section", "show_pina_sidebar_post");
    register_setting("posts_section", "show_lista_posts_sidebar");
    //register fields sidebar post

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
    <hr>
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
        
        <select class="select-search-input" name="show_lista_posts_slide" id="show_lista_posts_slide" <?= $val_select2 == "yes" ? "enable" : "disabled" ?>>
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
        <hr>
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
        
        <select class="select-search-input" name="show_lista_posts_sidebar" id="show_lista_posts_sidebar" <?= $val_pina_sidebar2 == "yes" ? "enable" : "disabled" ?>>
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

function display_posts_options_content(){
    echo "Configure a listagem de posts";
}



add_action("admin_init", "display_options");

?>