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

    add_action("admin_menu", "add_new_menu_items");

function display_options()
{
    

    //config setting API formulário de contato
    add_settings_section("header_section", "", "display_header_options_content", "theme-options");
    
    add_settings_field("link_acesse_conta", "Link de 'Acess sua conta'", "display_link_conta", "theme-options", "header_section");
    add_settings_field("link_visite_site", "Link de 'Visite nosso site'", "display_link_visite_site", "theme-options", "header_section");
    add_settings_field("show_slide_post", "Escolha a forma de listagem dos posts slides", "display_slide_post", "theme-options", "header_section");
    
    register_setting("header_section", "link_acesse_conta");
    register_setting("header_section", "link_visite_site");
    register_setting("header_section", "show_slide_post");

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
function display_slide_post(){
    ?>
    <hr>
        <select name="show_slide_post" id="show_slide_post">
            <option value="lastPost">Últimos posts</option>
            <option value="category">Categoria</option>
            <option value="keyword">Palavra-chave</option>
            <option value="moreread">Mais lidos</option>
        </select>

        <select name="show_by_category" id="show_by_category" style="display: none">
            <?php
                $terms = get_terms([
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ]);
                foreach($terms as $term){
                    echo "<option value='".$term->slug."'>".$term->name. "</option>";      
                }  
            ?>
        </select>

        <input type="text" name="show_by_keyword" id="show_by_keyword" style="display: none" placeholder="keyword...">

        <script>
            document.getElementById("show_slide_post").addEventListener("change", function(){
                var val_type = document.getElementById("show_slide_post").value;

                switch(val_type){
                    case "category":
                        document.getElementById("show_by_category").style.display = "inline-block";
                        document.getElementById("show_by_keyword").style.display = "none";
                    break;
                    case "keyword":
                        document.getElementById("show_by_keyword").style.display = "inline-block";
                        document.getElementById("show_by_category").style.display = "none";
                    break;
                    default:
                        document.getElementById("show_by_keyword").style.display = "none";
                        document.getElementById("show_by_category").style.display = "none";
                }
            })
        </script>
        <hr>
    <?php
}

function display_header_options_content(){
    echo "Aqui ficam as configurações gerais do site";
}



add_action("admin_init", "display_options");

?>