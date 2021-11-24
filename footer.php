        <footer>
            <div class="row">
                <div class="contact-info">
                    <div class="logo">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/logos/dr-nature.svg">
                        <p>Descobertas da ciência que transformam vidas.</p>
                    </div>

                    <div class="social-links">
                        <?php
                            $social_instagram = get_option('show_rodape_instagram');
                            $social_facebook = get_option('show_rodape_facebook');
                        ?>
                        <?php if($social_instagram != ""): ?>
                        <a href="<?= $social_instagram; ?>">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/instagram.svg">
                        </a>
                        <?php endif; ?>

                        <?php if($social_facebook != ""): ?>
                        <a href="<?= $social_facebook; ?>">
                            <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/facebook.svg">
                        </a>
                        <?php endif; ?>

                    </div>

                    <ul class="account">
                        <li>
                            <a href="<?= get_option('link_acesse_conta'); ?>" class="login"><img src="<?= get_template_directory_uri(); ?>/assets/img/icons/login.svg"> Acesse sua conta</a>
                        </li>
                    </ul>
                </div>

                <div class="links">
                    <?php
                        $args = array(
                            'menu' => 'menu footer 1',
                            'theme_location' => 'menu-footer-1',
                            'container' => false
                        );
                        wp_nav_menu( $args );
                    ?>
                    
                     <?php
                        $args = array(
                            'menu' => 'menu footer 2',
                            'theme_location' => 'menu-footer-2',
                            'container' => false
                        );
                        wp_nav_menu( $args );
                    ?>
                </div>


                <div class="other-links">
                    <?php
                        $rodape_link_title1 = get_option('show_rodape_title1');
                        $rodape_link1 = get_option('show_rodape_link1');
                        $rodape_img1 = get_option('show_rodape_img1');
                        $rodape_link_title2 = get_option('show_rodape_title2');
                        $rodape_link2 = get_option('show_rodape_link2');
                        $rodape_img2 = get_option('show_rodape_img2');
                    ?>
                    <ul>
                        <?php if($rodape_link1 != ""): ?>
                        <li>
                            <a href="<?= $rodape_link1; ?>">
                                <?= $rodape_link_title1; ?>
                                <img src="<?= wp_get_attachment_image_url( $rodape_img1, 'normal' ); ?>" class="fire">
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($rodape_link2 != ""): ?>
                        <li>
                            <a href="#">
                            <?= $rodape_link_title2; ?>
                            <img src="<?= wp_get_attachment_image_url( $rodape_img2, 'normal' ); ?>" class="fire">
                            </a>    
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="text">
                <p class="notice">As recomendações apresentadas são embasadas em pesquisas científicas. A Doutor Nature não apoia a automedicação.</p>

                <p>As informações contidas neste boletim são publicadas exclusivamente para fins informativos e não podem ser consideradas como aconselhamento médico pessoal.</p>
                <p>O leitor deve, para qualquer questão relativa à sua saúde e bem-estar, consultar um profissional devidamente credenciado pelas autoridades de saúde. O editor deste conteúdo não é médico ou pratica a medicina a qualquer título, ou qualquer outra profissão terapêutica. Apenas expressa sua opinião baseado em dados e fatos apresentados por agentes da saúde, ou conteúdo informativo disponível ao público, considerados confiáveis na data de publicação. Posto que as opiniões nascem de julgamentos e estimativas, estão sujeitas a mudanças.</p>
                <p>Elaborada por editores independentes da Doutor Nature, esta publicação é de uso exclusivo de seu destinatário. São estritamente proibidos, sem autorização por escrito do detentor dos direitos autorais, sob as penalidades previstas em lei, a comunicação ou a distribuição dos materiais incluídos neste boletim, bem como a reprodução total ou parcial, por qualquer meio ou processo, incluindo fotocópias e distribuição via computador.</p>
                <p>Rodovia Governador Mario Covas, S/N Primavera - Viana - KM 9,5- CEP: 29135-160 - Doutor Nature, CNPJ 26.434.850/0001-91</p>

                <p class="copyright">® <?= Date("Y"); ?> DOUTOR NATURE. Todos os direitos reservados.</p>
            </div>
        
        </footer>

        <!-- 
        <script src="<?= get_template_directory_uri(); ?>/assets/js/jquery-3.5.1.min.js"></script>
        -->
       
        
            <?php
                $popup_cookie = get_option('popup_cookie');
                if($popup_cookie == "custom" && !isset($_COOKIE['cnature'])): ?>
                <script>

                    function setCookie(cname, cvalue, exdays) {
                        const d = new Date();
                        d.setTime(d.getTime() + (exdays*24*60*60*1000));
                        let expires = "expires="+ d.toUTCString();
                        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                    }

                    var setup_cookie_days = <?= get_option('setup_popup_cookie'); ?>;
                    document.querySelector(".strip .close").addEventListener("click", function(){
                        setCookie('cnature', 'content', setup_cookie_days);
                    });


                </script>
                <?php
                
                endif;
            ?>
            
            
        <!-- wp footer -->
        <?php wp_footer(); ?>
        <!-- wp footer -->
        <?php

if(is_single()):
    ?>
        <script src="<?= get_template_directory_uri(); ?>/assets/js/pagina-interna.js"></script>
    <?php
else:
    ?>
        <script src="<?= get_template_directory_uri(); ?>/assets/js/home.js"></script>
    <?php
endif;
?>
<script>
 
<?php
    $terms = get_terms([
        'taxonomy' => 'category',
        'hide_empty' => false
    ]);    
?>
<?php foreach($terms as $term): ?>
    var show_btn<?= $term->term_id; ?> = true;
<?php endforeach; ?>  
if( $(window).width() < 980){
    console.log("menor");
    if(document.querySelector("#latest-posts .content")){
        document.querySelector("#latest-posts .content").innerHTML = "";
    }
    <?php
        
        $option_select_mobile_category = get_option('show_select_mobile_category');
        
        foreach($terms as $term):
            if($term->term_id == $option_select_mobile_category):
    ?>
    more_post_mobile<?= $term->term_id; ?>('category', '<?= $term->slug; ?>');
    filterPosts('#latest-posts .tab h4[data-categoria="<?= $term->slug; ?>"]', 'more_post_mobile<?= $term->term_id; ?>("category", "<?= $term->slug; ?>")');
    pageMobile<?= $term->term_id; ?>++;
    <?php endif; endforeach; ?>
}else{
    console.log("maior");
}


<?php $btn_morepost2 = get_option('show_button_loadpost_notpost') ?>
var msg_button2 = "<?= get_option('show_button_loadpost_msg'); ?>";


<?php  foreach($terms as $term): ?>

var pageMobile<?= $term->term_id ?> = 1;
function more_post_mobile<?= $term->term_id; ?>(type, val = "", catPage){

    $('#text-button-load').hide();
    $('.c-loader').show();

    console.log("valor da variável pageMobile<?= $term->term_id; ?>: "+pageMobile<?= $term->term_id; ?>);
    var data = {
        'action': 'load_posts_by_ajax',
        'page': pageMobile<?= $term->term_id; ?>,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    };
    console.log("valor da variável depois do var pageMobile<?= $term->term_id; ?>: "+pageMobile<?= $term->term_id; ?>);
    

    $.post(blog.ajaxurl, data, function(response) {
        if($.trim(response) != '') {
            $('#latest-posts .content').append(response);
            pageMobile<?= $term->term_id; ?>++;
        } else {
            if(!show_btn<?= $term->term_id; ?>){
                <?php if($btn_morepost2 == "hide_buttonpost"): ?>
                    $('.loadmore').hide();
                <?php else: ?>
                    $('.loadmore').text(msg_button2);
                    $('.loadmore').removeClass("see-more");
                    $('.loadmore').addClass("latest-posts-notpost");
                <?php endif; ?>
            }
            show_btn<?= $term->term_id; ?> = false;
        }
        $('#text-button-load').show();
        $('.c-loader').hide();
    });


    pageMobile<?= $term->term_id; ?>2 = pageMobile<?= $term->term_id; ?>+1
    var data2 = {
        'action': 'load_posts_by_ajax',
        'page': pageMobile<?= $term->term_id; ?>2,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    }
    $.post(blog.ajaxurl, data2, function(response) {
        if($.trim(response) == '') {
            show_btn<?= $term->term_id; ?> = false;
            if(!show_btn<?= $term->term_id; ?>){
                <?php if($btn_morepost2 == "hide_buttonpost"): ?>
                    $('.loadmore').hide();
                <?php else: ?>
                    $('.loadmore').text(msg_button2);
                    $('.loadmore').removeClass("see-more");
                    $('.loadmore').addClass("latest-posts-notpost");
                <?php endif; ?>
            }
        }
    });
    
}
                                    
<?php endforeach; ?>

<?php foreach($terms as $term):
/*
$('#latest-posts .tab h4').on('click', function() {
    var at = $(this).attr('data-categoria');
    var id_cat = $(this).attr('id');
    var func_btn = "";
    console.log("valor categoria: "+at);
    if(eval("show_btn"+id_cat)){
        var func_btn = "more_post_mobile"+id_cat+"('category', '"+at+"')";
        $('.loadmore').show();
    }else{
        $('.loadmore').hide();
    }
    if(eval("pageMobile"+id_cat) == 1){
        var at = $(this).attr('data-categoria');
        console.log("valor categoria: "+at);
        
        //eval("more_post_mobile"+id_cat+"('category', '"+at+"')");
        
    }
    filterPosts(this, func_btn);
    console.log("valor da show_btn"+id_cat+": "+ eval("show_btn"+id_cat));
    console.log("categoria: "+at);
});
*/    
    
?>


$('#latest-posts .tab h4[data-categoria="<?= $term->slug; ?>"]').on('click', function() {
    //var at = $(this).attr('data-categoria');
    var id_cat = $(this).attr('id');
    var func_btn = "";
    console.log("valor categoria: <?= $term->slug ?>");
    if(show_btn<?= $term->term_id;//verificar se a variavel que permite exibir o botão é verdadeira ?>){
        
        $('.loadmore').show();
        $('.loadmore').removeClass("latest-posts-notpost");
        $('.loadmore').addClass("see-more");
        var func_btn = "more_post_mobile<?= $term->term_id; ?>('category', '<?= $term->slug; ?>')";
        document.querySelector(".loadmore").innerHTML = '<span id="text-button-load" style=""><?= get_option('show_text_button_loadpost'); ?></span><span style="display: none;" class="c-loader"></span>';
        
    }else{
        $('.loadmore').text(msg_button2);
        $('.loadmore').removeClass("see-more");
        $('.loadmore').addClass("latest-posts-notpost");
    }
    if(pageMobile<?= $term->term_id; ?> == 1){
        //var at = $(this).attr('data-categoria');
        $('#text-button-load').hide();
        $('.c-loader').show();
        more_post_mobile<?= $term->term_id; ?>('category', '<?= $term->slug; ?>');
        
    }
    filterPosts(this, func_btn);
    console.log("valor da show_btn<?= $term->term_id; ?>: "+ show_btn<?= $term->term_id; ?>);
    console.log("categoria: <?= $term->slug ?>");
});
<?php endforeach; ?>
                        
            </script>
    </body>

</html>
