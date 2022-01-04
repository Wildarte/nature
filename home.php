<?php
    get_header();
?>
        <header>
            <style>
                .news-carousel .news-item .item-body ul.post-categories li a{
                         position: unset;
                         top: unset; 
                         left: unset; 
                         width: unset;
                         height: unset;
                         display: block;
                        }
            </style>
            
            <h2 class="main-title">Conteúdo</h2>
            <div class="news-carousel">
            <style>
                        .owl-stage{
                            display: flex;
                            align-items: flex-start;
                        }
                    </style>
                <div class="carousel-wrapper">
                    
                    <?php
                        
                        $slide_post = get_option('show_slide_post');
                        $option_pina_slide_post = get_option('show_pina_slide_post');//add
                        $slide_post_count = get_option('show_slide_post_count');
                        $slide_cat = get_option('show_slide_post_category');
                        $post_pinado_slide = get_option('show_lista_posts_slide');//add
                        $post_id_page_slide = get_page_by_title($post_pinado_slide, OBJECT, 'post');//add
                        
                       
                        
                       

                        if($slide_post_count <= 1){
                            $new_val_count_posts_slide = 1;
                        }else{
                            $new_val_count_posts_slide = $slide_post_count;
                        }
                        
                        //se variavel que armazena a quantidade posts estiver vazia entao ela recebe o valor 4
                        //if(empty($slide_post_count)) $slide_post_count = 4;
                        
                        switch($slide_post):
                            case "lastPost":
                                if($option_pina_slide_post == "yes"){
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        'orbder' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide-1,
                                        'post__not_in' => [$post_id_page_slide->ID]
                                    ];
                                }else{
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        'orbder' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide
                                    ];
                                }
                            break;
                            case "category":
                                $slide_post_cat = get_option('show_slide_post_category');
                                if($option_pina_slide_post == "yes"){
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        'category_name' => $slide_post_cat,
                                        'order' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide-1,
                                        'post__not_in' => [$post_id_page_slide->ID]
                                    ];
                                }else{
                                    
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        'category_name' => $slide_post_cat,
                                        'order' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide
                                    ];
                                }
                                
                            break;
                            case "keyword":
                                $search_keyword = get_option('show_slide_post_keyword');
                                if($option_pina_slide_post == "yes"){
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        's' => $search_keyword,
                                        'posts_per_page' => $new_val_count_posts_slide-1,
                                        'post__not_in' => [$post_id_page_slide->ID]
                                    ];
                                }else{
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        's' => $search_keyword,
                                        'posts_per_page' => $new_val_count_posts_slide
                                    ];
                                }
                            break;
                            case "moreread":
                                if($option_pina_slide_post == "yes"){
                                    $args_post_slide = [
                                        'posts_per_page' => $new_val_count_posts_slide,
                                        'meta_key' => 'wpb_post_views_count',
                                        'orderby' => 'meta_value_num',
                                        'order' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide-1,
                                        'post__not_in' => [$post_id_page_slide->ID]
                                    ];
                                }else{
                                    $args_post_slide = [
                                        'posts_per_page' => $new_val_count_posts_slide,
                                        'meta_key' => 'wpb_post_views_count',
                                        'orderby' => 'meta_value_num',
                                        'order' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide,
                                    ];
                                }
                            break;
                            default:
                                if($option_pina_slide_post == "yes"){
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        'orbder' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide-1,
                                        'post__not_in' => [$post_id_page_slide->ID]
                                    ];
                                }else{
                                    $args_post_slide = [
                                        'post_type' => 'post',
                                        'orbder' => 'DESC',
                                        'posts_per_page' => $new_val_count_posts_slide
                                    ];
                                }
                        endswitch;
                       
                        
                        $result_post_slide = new WP_query($args_post_slide);

                    ?>

                    <?php if($result_post_slide->have_posts() || $slide_post_count >= 1): ?>
                        
                        <?php
                        if($option_pina_slide_post == "yes"): 
                            $args_pinado_post = [
                                'post_type' => 'post',
                                'p' => $post_id_page_slide->ID
                            ];
                            $result_pinado_post = new WP_Query($args_pinado_post);

                            if($result_pinado_post->have_posts()): while($result_pinado_post->have_posts()):
                                $result_pinado_post->the_post(); ?>
                                <div class="news-item">
                                    <div class="item-head">
                                        <?php 
                                            $thumb = get_the_post_thumbnail_url(null, 'larger');
                                            $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                                        ?>
                                        <div class="banner" style="background-image: url('<?= $thumb; ?>')"></div>
                                        <div class="navigation"></div>
                                    </div>

                                    <div class="item-body">
                                        <?= the_category() ?>
                                        <h3 class="title"><?= get_the_title(); ?></h3>
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

                                        <div class="author">
                                        <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                            <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" class="avatar">
                                            <p class="name"><?= get_the_author(); ?></p>
                                            <time> <?php echo date_post(get_the_date('d-m-Y'), get_the_time('H:i:s'));  ?> </time>
                                        </div>

                                        <a href="<?= the_permalink(); ?>"></a>
                                    </div>
                                </div>
                            <?php
                                endwhile;
                            endif; wp_reset_query(); wp_reset_postdata();
                    ?>

                    <?php endif; ?>
                    <?php if($slide_post_count > 1 || $option_pina_slide_post == 'no'): ?>
                    <?php while($result_post_slide->have_posts()): $result_post_slide->the_post(); ?>
                    
                    <div class="news-item">
                        <div class="item-head">
                            <?php 
                                $thumb = get_the_post_thumbnail_url(null, 'larger');
                                $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                            ?>
                            <div class="banner" style="background-image: url('<?= $thumb; ?>')"></div>
                            <div class="navigation"></div>
                        </div>

                        <div class="item-body">
                            <?= the_category() ?>
                            <h3 class="title"><?= get_the_title(); ?></h3>
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

                            <div class="author">
                            <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" class="avatar">
                                <p class="name"><?= get_the_author(); ?></p>
                                <time> <?php echo date_post(get_the_date('d-m-Y'), get_the_time('H:i:s'));  ?> </time>
                            </div>

                            <a href="<?= the_permalink(); ?>"></a>
                        </div>
                    </div>
                    <?php endwhile; endif; endif; wp_reset_query(); wp_reset_postdata(); ?>

                </div>

                <div class="carousel-pagination">
                    <div class="prev">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/prev.svg">
                    </div>

                    <div class="next">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/next.svg">
                    </div>
                </div>
            </div>
        </header>

        <aside>
                <?php

                    $option_mais_lidos = get_option('show_sidebar_post');
                    $option_pina_sidebar = get_option('show_pina_sidebar_post');
                    $option_sidebar_post_count = get_option('show_sidebar_post_count');
                    $post_pinado_sidebar = get_option('show_lista_posts_sidebar');
                    $post_id_page = get_page_by_title($post_pinado_sidebar);

                    $posts_selected = get_option('show_lista_posts_sidebar');//pega os posts que o usuário fixou
                    $count_selected_posts = count($posts_selected);//conta quantos posts o usuário fixou no sidebar

                    if($option_pina_sidebar == 'yes'){
                        $post_id_page = get_page_by_title($post_pinado_sidebar, OBJECT, 'post');
                    }
                    
                    
                    if($option_sidebar_post_count <= 1){
                        $new_val_count_posts_sidebar = 1;
                    }else{
                        $new_val_count_posts_sidebar = $option_sidebar_post_count;
                    }
                    
                    switch($option_mais_lidos):
                        case "lastPost":
                            if($option_pina_sidebar == 'yes'){
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                    'posts_per_page' => $new_val_count_posts_sidebar-$count_selected_posts,
                                    'post__not_in' => $posts_selected
                                ];
                            }else{
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                    'posts_per_page' => $new_val_count_posts_sidebar
                                ];
                            }
                        break;
                        case "category":
                            $sidebar_post_cat = get_option('show_sidebar_post_category');
                            if($option_pina_sidebar == 'yes'){
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'category_name' => $sidebar_post_cat,
                                    'order' => 'DESC',
                                    'posts_per_page' => $new_val_count_posts_sidebar-$count_selected_posts,
                                    'post__not_in' => $posts_selected
                                ];
                            }else{
                                
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'category_name' => $sidebar_post_cat,
                                    'order' => 'DESC',
                                    'posts_per_page' => $new_val_count_posts_sidebar
                                ];
                            }
                        break;
                        case "keyword":
                            $search_keyword_sidebar = get_option('show_sidebar_post_keyword');
                            if($option_pina_sidebar == 'yes'){
                                $args_last_post = [
                                    'post_type' => 'post',
                                    's' => $search_keyword_sidebar,
                                    'posts_per_page' => $new_val_count_posts_sidebar-$count_selected_posts,
                                    'post__not_in' => $posts_selected
                                ];
                            }else{
                                $args_last_post = [
                                    'post_type' => 'post',
                                    's' => $search_keyword_sidebar,
                                    'posts_per_page' => $new_val_count_posts_sidebar
                                ];
                            }
                        break;
                        case "moreread":
                            if($option_pina_sidebar == 'yes'){
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                    'meta_key' => 'wpb_post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'posts_per_page' => $new_val_count_posts_sidebar-$count_selected_posts,
                                    'post__not_in' => $posts_selected
                                ];
                            }else{
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                    'meta_key' => 'wpb_post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'posts_per_page' => $new_val_count_posts_sidebar
                                ];
                            }
                        break;
                        case "pinados":
                            $posts = get_option('show_sidebar_post_select_multiple');

                            $args_last_post = [
                                'post__in' => $posts,
                                'post_type' => 'post',
                                'posts_per_page' => 10
                            ];
                        break;
                        default:
                            if($option_pina_sidebar == 'yes'){
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                    'meta_key' => 'wpb_post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'posts_per_page' => $new_val_count_posts_sidebar-$count_selected_posts,
                                    'post__not_in' => $posts_selected
                                ];
                            }else{
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                    'meta_key' => 'wpb_post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'posts_per_page' => $new_val_count_posts_sidebar
                                ];
                            }
                            
                    endswitch;

                    //busca pelos posts mais lidos
                    $popularpost = new WP_Query($args_last_post);
                    // array( 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'post__not_in' => [49] ) 

                    if($popularpost->have_posts() || $option_sidebar_post_count >= 1):
                ?>
            <section id="most-read">
                <h2>Artigos mais lidos</h2>

                <div class="most-read-news">
                    <?php if($option_pina_sidebar == "yes"):
                    
                    

                    for($i = 0; $i < $count_selected_posts; $i++):
                        $args_pinado_post_sidebar = [
                            //'post__in' => get_option('show_lista_posts_sidebar'),
                            'post_type' => 'post',
                            'p' => $posts_selected[$i]
                        ];
                        $result_pinado_post_sidebar = new WP_Query($args_pinado_post_sidebar);

                        if($result_pinado_post_sidebar->have_posts()):
                            //while($result_pinado_post_sidebar->have_posts()):
                            $result_pinado_post_sidebar->the_post();
                    ?>
                        <div class="most-read-item">
                            <div class="item-number"></div>
                            <div class="item-body">
                                <h4 class="title"><?php the_title(); ?></h4>
                                <div class="author">Por <?= get_the_author(); ?> - <?php echo date_post(get_the_date('d-m-Y'), get_the_time('H:i:s'));  ?></div>
                                <a href="<?php the_permalink(); ?>" class="item-link"></a>
                            </div>
                        </div>
                    <?php /*endwhile;*/ endif; wp_reset_query(); wp_reset_postdata(); ?>
                    
                    <?php endfor; ?>
                    
                    <?php endif; ?>

                    <?php
                        if(($count_selected_posts >= $option_sidebar_post_count) && $option_pina_sidebar == 'yes'):
                            echo "";
                        
                        else: if($option_sidebar_post_count > 1 || $option_pina_sidebar != 'yes'):
                            
                            while( $popularpost->have_posts() ) : $popularpost->the_post();            
                    ?>

                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title"><?php the_title(); ?></h4>
                            <div class="author">Por <?= get_the_author(); ?> - <?php echo date_post(get_the_date('d-m-Y'), get_the_time('H:i:s'));  ?></div>
                            <a href="<?php the_permalink(); ?>" class="item-link"></a>
                        </div>
                    </div>

                    <?php endwhile; wp_reset_query(); wp_reset_postdata();  endif; endif; ?> 

                </div>
            </section>
            <?php endif; wp_reset_query(); wp_reset_postdata(); ?>

            <?php include 'inc/asideCategory.php'; ?>

            
            <?php 
                $show_ad_sidebar = get_option('show_onoff_ads_sidebar');
                if($show_ad_sidebar != "on"):
                    include 'inc/adsidebar.php';
                endif;
            ?>
        </aside>

        <main style="width: 100%;">
            <style>
                .tab h4:nth-child(1){
                    /*text-align: left!important;*/
                    margin-left: 0px!important;
                    padding-left: 0px!important;
                    justify-content: left!important;
                    
                }
                .tab h4:nth-child(3){
                    /*text-align: right!important;*/
                    margin-right: 0px!important;
                    padding-right: 0px!important;
                    justify-content: right!important;
                }
            </style>
            <section id="latest-posts">
                <h2>Últimas postagens</h2>
                
                <div class="tab">
                    <?php

                        $terms = get_terms([
                            'taxonomy' => 'category',
                            'hide_empty' => false,
                            'orderby' => 'term_id'
                        ]);
                        foreach($terms as $term){
                            
                            echo "<h4 data-categoria='".$term->slug."' class='' id='".$term->term_id."'>".$term->name."</h4>";
                            
                        }
                       
                        
                    ?>
                </div>


                <div class="content">

                    <?php 
                        $args_ultimos_posts = [
                            'post_type' => 'post',
                        ];

                        $result_ultimos_posts = new WP_Query($args_ultimos_posts);

                        
                    ?>
                    
                    <?php if($result_ultimos_posts->have_posts()): while($result_ultimos_posts->have_posts()): $result_ultimos_posts->the_post(); ?>

                    <div class="latest-posts-item" data-categoria="<?= get_the_category()[0]->slug; ?>">
                        <?php 
                            $thumb = get_the_post_thumbnail_url(null, 'thumbnail');
                            $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                        ?>
                        
                        <div class="image" style="background-position: center; background-size: cover; background-image: url('<?= $thumb; ?>')"></div>

                        <div class="text">
                            <?= the_category() ?>

                            <!-- add uma div que contém o título e o resumo e também o link para o post -->
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
                                <time> <?= date_post(get_the_date('d-m-Y'), get_the_time('H:i:s')); ?> </time>
                                
                            </div>

                            
                        </div>
                        
                    </div>
                    <script>
                        //document.querySelectorAll(".latest-posts-item .text .post-summary").style.display = "none";
                    </script>
                    <?php endwhile; endif;  wp_reset_query(); wp_reset_postdata(); ?>

                </div>

                <?php
                    $btn_morepost = get_option('show_button_loadpost_notpost');
                    $msg_button = get_option('show_button_loadpost_msg');

                    if($btn_morepost == "hide_buttonpost"): 
                ?>
                <button onclick="more_post('lastPost')" class="loadmore see-more"><span id="text-button-load"><?= get_option('show_text_button_loadpost'); ?></span> <span style="display: none;" class="c-loader"></span> </button>
                
                <?php else: ?>

                <button onclick="more_post2('lastPost', '', '<?= $msg_button; ?>')" class="loadmore see-more"><span id="text-button-load"><?= get_option('show_text_button_loadpost'); ?></span> <span style="display: none;" class="c-loader"></span> </button>

                <?php endif; ?>
                
            </section>
        </main>

        
       
        <section id="cards">
            
            <?php 
                $show_ad_footer = get_option('show_onoff_ads_footer');
                if($show_ad_footer != "on"):
                    include 'inc/adfooter.php';
                endif;
            ?>

            <?php 
                $show_ad_sidebar = get_option('show_onoff_ads_sidebar');
                if($show_ad_sidebar != "on"):
                    include 'inc/allsuplements.php';
                endif;
            ?>
        </section>
       
        
<?php get_footer(); ?>