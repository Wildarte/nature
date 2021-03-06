<?php

    function nature_scripts(){
        wp_register_script("n-jquery", get_template_directory_uri().'/assets/js/jquery-3.5.1.min.js', [], false, true);
        wp_register_script('owl-carousel', get_template_directory_uri() . '/lib/owl-carousel/owl.carousel.min.js', ['n-jquery'], false, true);
        wp_register_script('sticky-js', get_template_directory_uri() . '/lib/sticky-js/sticky.jquery.js', [], false, true);
        wp_register_script('script', get_template_directory_uri() . '/assets/js/script.js', [], false, true);
        //wp_register_script('pagina-interna', get_template_directory_uri() . '/assets/js/pagina-interna.js', [], false, true);

        wp_enqueue_script(['owl-carousel', 'sticky-js', 'script']);
    }
    add_action('wp_enqueue_scripts', 'nature_scripts');



    //config ajax
    function blog_scripts() {
        // Register the script
        wp_register_script( 'custom-script', get_stylesheet_directory_uri(). '/assets/js/custom.js', array('jquery'), false, true );
     
        // Localize the script with new data
        $script_data_array = array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'security' => wp_create_nonce( 'load_more_posts' ),
        );

        wp_localize_script( 'custom-script', 'blog', $script_data_array );
     
        // Enqueued script with localized data.
        wp_enqueue_script( 'custom-script');
    }
    add_action( 'wp_enqueue_scripts', 'blog_scripts' );

    
    //add scripts that load more posts =================================================================
    function nature_styles(){
        wp_register_style('owl-carousel-style', get_template_directory_uri() . '/lib/owl-carousel/owl.carousel.min.css', [], false, false);
        wp_register_style('owl-theme-style', get_template_directory_uri() . '/lib/owl-carousel/owl.theme.default.min.css', [], false, false);
        //wp_register_style('reseter', get_template_directory_uri() . '/assets/css/reseter.css', [], false, false);
        //wp_register_style('home', get_template_directory_uri() . '/assets/css/home.css', [], false, false);
        //wp_register_style('interno', get_template_directory_uri() . '/assets/css/pagina-interna.css', [], false, false);

        wp_enqueue_style(['owl-carousel-style','owl-theme-style']);
    }
    add_action('wp_enqueue_scripts', 'nature_styles');
    //add scripts that load more posts =================================================================


    // Fun????es para Limpar o Header
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0 );
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Habilitar Menus
    add_theme_support('menus');

    //add support to thumbnail post
    add_theme_support( 'post-thumbnails', ['post']);


    //add custom length to excerpt
    function my_excerpt_length($length){
        return 20;
    }
    add_filter('excerpt_length', 'my_excerpt_length');
    
    //function for custom excerpt read more
    function wpdocs_excerpt_more( $more ) {
        return '...';
    }
    add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );



    // Registrar o Menu
    
    function register_my_menu() {
        register_nav_menus([
            'menu-principal' => __( 'menu principal' ),
            'menu-footer-1' => __('menu footer 1'),
            'menu-footer-2' => __('menu footer 2')
        ]);
    }
    add_action( 'init', 'register_my_menu' );



    //function for count view more popular posts
    function wpb_set_post_views($postID) {
        $count_key = 'wpb_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    //To keep the count accurate, lets get rid of prefetching
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    
    require 'admin/postbox.php';
    require 'admin/field_post.php';
    require 'admin/controlPage.php';


    //MY FUNCTIONS ======================================================


    //  FUNCAO DE TESTE TALVEZ EU A EXCLUA
    //funcao que atribui um valor para ranking de posts 
    function wpb_set_count_post($postID, $val){
        $count_key_post = 'wpb_count_post';
        $contagem = get_post_meta($postID, $count_key_post, true);
        if($contagem == ''){
            delete_post_meta(155, $count_key_post);
            add_post_meta(155, $count_key_post, '1');
            echo "caiu no if"."<br>";
            echo "valor da variavel contagem: ".$contagem;
        }else{
            update_post_meta($postID, $count_key_post, $val);
            echo "nao caiu no if"."<br>";
        }
    }
    


    //funcao para verificar se existem posts
    function verifa_posts($args){
        $the_resp = new WP_Query($args);
        if($the_resp->have_posts()){
            return true;
        }else{
            return false;
        }
    }

    //get id term by slug term
    function get_idterm_by_slugterm($slugTerm){
        $get_id_term_query = [
            'taxonomy' => 'category',
            'hide_empty' => false,
            'slug' => $slugTerm,
        ];
        $get_id_term = get_terms($get_id_term_query);

        if($get_id_term){
            return $get_id_term[0]->term_id;
            echo "retornou true";
        }else{
            false;
            echo "retornou false";
        }
    }
    
    //get name term by slug term
    function get_nameterm_by_slugterm($slugTerm){
        $get_id_term_query = [
            'taxonomy' => 'category',
            'hide_empty' => false,
            'slug' => $slugTerm,
        ];
        $get_id_term = get_terms($get_id_term_query);

        if($get_id_term){
            return $get_id_term[0]->name;
            echo "retornou true";
        }else{
            false;
            echo "retornou false";
        }
    }

    //MY FUNCTIONS ======================================================



    //this code care about the load post with ajax ===============================================
    add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
    add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

    function load_posts_by_ajax_callback() {
        check_ajax_referer('load_more_posts', 'security');
        $paged = $_POST['page'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $search = $_POST['search'];

        switch($type):
            case "lastPost":
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'paged' => $paged
                );
            break;
            case "category":
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'category_name' => $category,
                    'paged' => $paged
                );
            break;
            case "search":
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    's' => $search,
                    'paged' => $paged
                );
            break;
            default:
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'paged' => $paged
                );
        endswitch;
        
        $blog_posts = new WP_Query( $args );
        ?>
     
        <?php if ( $blog_posts->have_posts() ) : ?>
            <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
                <div class="latest-posts-item" data-categoria="<?= get_the_category()[0]->slug; ?>">
                    <?php 
                        $thumb = get_the_post_thumbnail_url(null, 'thumbnail');
                        $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                    ?>
                    
                    <div class="image" style="background-position: center; background-size: cover; background-image: url('<?= $thumb; ?>')"></div>

                    <div class="text">
                        <?= the_category(); ?>
                        <!-- add uma div que cont??m o t??tulo e o resumo e tamb??m o link para o post -->
                        <div class="content-post-hover" style="position: relative;">
                            <h4 class="title"><?= get_the_title(); ?></h4>
                            <p class="post-summary">
                            <?php
                                $resumo = get_post_meta(get_the_ID(), 'meta_resumo_post', true);

                                if($resumo != ""){
                                    echo $resumo." ...";
                                }else{
                                    echo get_the_excerpt();
                                }
                            ?>
                            </p>
                            <a class="link" href="<?php the_permalink(); ?>"></a>
                        </div>
                        <div class="author">
                            <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                            <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>">
                            <p class="name"><?= get_the_author(); ?></p>
                            <time> <?php echo date_post(get_the_date('d-m-Y'), get_the_time('H:i:s'));  ?> </time>
                            
                        </div>

                    </div>
                    
                </div>
            <?php endwhile; ?>
            <?php
        endif;  wp_reset_query(); wp_reset_postdata();
     
        wp_die();
    }
    //this code care about the load post with ajax ===============================================


    //function for limit characters of the posts
    function get_first_paragraph(){
        global $post;
        $str = wpautop( get_the_content() );
        $str = substr( $str, 0, strpos( $str, ' ' ) + 170 );
        $str = strip_tags($str, '<a><strong><em><img>');
        $words =  explode(" ", $str);
        $text_return = "";
        for($i = 0; $i < count($words) - 1; $i++):
            $text_return .= $words[$i]. " ";
        endfor;
        return $text_return . ' ...';
    }


    function date_post($dt_post, $hr_post){
        date_default_timezone_set('America/Sao_Paulo'); //pega o horario de sao paulo
        $date_return = "";
        $hora_post =  $hr_post; //get_the_time('H:i:s'); //pega a hora do post
        $hora_atual = date('H:i:s'); //pega a hora atual
        
        $data_post = $dt_post; //get_the_date('d-m-Y'); //pega a data do post
        $data_hoje = date('d-m-Y'); //pega a data de hoje
        

        //se a data do post for igual a data de hoje entao quer dizer que o post foi publicado no mesmo dia entao a fun????o vai trabalhar com horas e minutos
        if($data_post == $data_hoje){

            $datetime1 = new DateTime($hora_post); //cria um objeto DataTime com a hora do post
            $datetime2 = new DateTime($hora_atual);//cria um objeto DataTime com a hora atual
            
            $interval = $datetime1->diff($datetime2); //subtrai a hora atual pela hora do post

            //se a hora do post for maior que zero
            if($interval->format('%H') > 0){

                //se hora for maior que 1 vai retornar o hor??rio o horario do post seguido pela palavra hora
                if($interval->format('%H') > 1){
                    $date_return = "H?? ".$interval->format('%h')." horas";

                //se a hora for maior que 1 vai retornar o hor??rio do post seguido pela palavra horas
                }else{
                    $date_return = "H?? ".$interval->format('%H')." hora";
                }


            //se a hora do post nao ofor maior que zero
            }elseif($interval->format('%i') > 0){

                //retorna o hor??rio do post em minutos
                $date_return = "H?? ".$interval->format('%i')." minutos";

            //se nao retorna o hor??rio do post em  segundos   
            }elseif($interval->format('%s') > 0){
                $date_return = "H?? ".$interval->format('%s')." segundos";
            }


        //se a data do post nao for igual a data de hoje
        }else{

            $data1 = new DateTime($data_post); //cria um objeto DataTime com a data do post
            $data2 = new DateTime($data_hoje); //cria um objeto DataTime com a data de hoje

            $return_data = $data1->diff($data2); //subtrai a data de hoje pela data do post

            //se o resultado da subtra????o das datas for igual a 1
            if($return_data->format('%d') == 1){

                // entao a data do post foi ontem
                $date_return = "Ontem ??s ".get_the_time();

            //se a subtra????o das datas dos posts nao for igual a 1 entao vai retornar a data do post normal
            }else{
                $date_return = get_the_date('d/m/Y');
            }
            
        }

        return $date_return;
    }

    
?>