<?php


//box posts =============================================================
function meta_box_post() {
    add_meta_box( 'my-meta-box-id', 'Indicação de posts', 'meta_box_post_indica', 'post', 'normal', 'high' ); 
}

function meta_box_post_indica() {
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    $value_indica_post_myself = get_post_meta(get_the_ID(), 'indica_post_myself', true);//retorna se o usuário selecionar indicar o post por ele mesmo
    $value_meta_indica_select = get_post_meta(get_the_ID(), 'meta_indica_select', true);
    //echo $value_indica_post_myself;
    //echo $value_meta_indica_select;
    ?>
        <p>
            <label for="">Indicar pela categoria atual <strong>(PADRÃO)</strong> </label><br> ou
            Permitir que eu mesmo escolha: <select type="radio" name="indica_post_myself" id="ind_post_my">
                <?php if(isset($value_indica_post_myself)): if($value_indica_post_myself == "yes"): ?>
                    <option value="yes">Sim</option>
                    <option value="no">Não</option>
                <?php else: ?>
                    <option value="no">Não</option>
                    <option value="yes">Sim</option>
                <?php endif; endif; ?>
                </select>
        </p>

        <div id="select_indic_post" style="display: <?= $value_indica_post_myself == "yes" ? "display" : "none" ?>">
            <label for="texto_meta_box">Indicar por</label>
            <select name="meta_indica_select" id="select_indica_post">
                <option value="lastPost">Últimos Posts</option>
                <option value="category">Categoria</option>
                <option value="keyword">Palavra-chave</option>
                <option value="moreread">Posts mais lidos</option>
            </select>
            <p id="by_category" style="display: none;">
                <label for="label_by_category">Selecione a categoria</label>
                <select name="meta_indica_categoria" id="">

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
            </p>

            <p id="by_word" style="display: none;">
                <label for="label_by_keyword">Digite uma palavra-chave</label>
                <input type="text" name="meta_indica_keyword" id="campo_keyword" placeholder="...">
            </p>
        </div>
        
        <h3>Indicação de Posts: <span>

        <?php

            if(isset($value_indica_post_myself) && $value_indica_post_myself == "yes"):
                switch($value_meta_indica_select):

                    case "lastPost":
                        echo "Últimos Posts";
                    break;
                    case "category":
                        echo "Pela categoria: ";
                        $terms = get_terms([
                            'taxonomy' => 'category',
                            'hide_empty' => false,
                            'slug' => get_post_meta(get_the_ID(), 'meta_indica_categoria', true),
                        ]);
                        foreach($terms as $term){
                            echo "<span style='color: orange'>".$term->name."</span>"; 
                        }
                    break;
                    case "keyword":
                        echo "Palavra-chave: <span style='color: orange'>\"".get_post_meta(get_the_ID(), 'meta_indica_keyword', true)."\"</span>";
                    break;
                    case "moreread":
                        echo "Posts Mais lidos";
                    break;
                    default:
                        echo "(Método Padrão)";

                endswitch;
            else:
                echo "(Método Padrão)";
            endif;

        ?>

        </span></h3>
        
        <script>
            document.getElementById("ind_post_my").addEventListener("click", function(){
                if(document.getElementById("ind_post_my").value == "yes"){
                    document.getElementById("select_indic_post").style.display = "block";
                }else{
                    document.getElementById("select_indic_post").style.display = "none";
                    document.getElementById("campo_keyword").value = "";
                    
                }
            })
            document.getElementById("select_indica_post").addEventListener("click", function(){
                var val_return = document.getElementById("select_indica_post").value;
                
                if(val_return == "keyword"){
                    document.getElementById("by_word").style.display = "block";
                    document.getElementById("by_category").style.display = "none";
                }else if(val_return == "category"){
                    document.getElementById("by_word").style.display = "none";
                    document.getElementById("by_category").style.display = "block";
                }else{
                    document.getElementById("by_word").style.display = "none";
                    document.getElementById("by_category").style.display = "none";
                }
            });
        </script>
    <?php
}
add_action( 'add_meta_boxes', 'meta_box_post' );


function meta_box_post_save( $post_id ){

    //if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

    //$allowed = array(
    //    'a' => array(
    //    'href' => array()
    //    )
    //    );
    
    if(isset($_POST['indica_post_myself'])) update_post_meta($post_id, 'indica_post_myself', $_POST['indica_post_myself']);

    if( isset( $_POST['meta_indica_select'] ) )
    update_post_meta( $post_id, 'meta_indica_select', $_POST['meta_indica_select'] );
    
    if( isset( $_POST['meta_indica_categoria'] ) )
    update_post_meta( $post_id, 'meta_indica_categoria',$_POST['meta_indica_categoria'] );
    
    if(isset($_POST['meta_indica_keyword'])) update_post_meta($post_id, 'meta_indica_keyword', $_POST['meta_indica_keyword']);
        
}
add_action( 'save_post', 'meta_box_post_save' );
//box posts ====================================================================================





//add meta box for banner code =================================================================
function meta_box_resumo_post() {
    add_meta_box( 'my-meta-box-banner', 'Resumo do Post', 'meta_box_banner', 'post', 'normal', 'high' ); 
}

function meta_box_banner_save( $post_id ){

    //if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

    //$allowed = array(
    //    'a' => array(
    //    'href' => array()
    //    )
    //    );
    
    if(isset($_POST['indica_post_myself'])) update_post_meta($post_id, 'indica_post_myself', $_POST['indica_post_myself']);

    if( isset( $_POST['meta_resumo_post'] ) )
    update_post_meta( $post_id, 'meta_resumo_post', $_POST['meta_resumo_post'] );
        
}
add_action('save_post', 'meta_box_banner_save');


function meta_box_banner() {
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    $value_resumo = get_post_meta(get_the_ID(), 'meta_resumo_post', true);
    ?>
        <div style="display: flex">
            <label for="" style="font-size: 1.3em; margin-right: 10px">Resumo da publicação</label>
            <textarea id="" name="meta_resumo_post" placeholder="..." cols="30" rows="5" maxlength="150"><?= $value_resumo != "" ? $value_resumo : ""; ?></textarea>
        </div>
        <p style="text-align: center;">Escreva um resumo da publicação, procure chamar a atenção e incentivar o usuário a clicar no Post (máximo de 150 caractéres) </p>
        <br>

        <script src="<?= get_template_directory_uri(); ?>/admin/ajaxpost.js"></script>
    <?php
}
add_action('add_meta_boxes', 'meta_box_resumo_post');


?>