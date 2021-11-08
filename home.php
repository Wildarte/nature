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
                                        <img class="banner" src="<?= $thumb; ?>">
                                        <div class="navigation"></div>
                                    </div>

                                    <div class="item-body">
                                        <?= the_category() ?>
                                        <h3 class="title"><?= get_the_title(); ?></h3>
                                        <p class="post-summary"><?= get_the_excerpt(); ?></p>

                                        <div class="author">
                                        <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                            <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" class="avatar">
                                            <p class="name"><?= get_the_author(); ?></p>
                                            <time> <?php the_time("d/m/Y");  ?> às <?= the_time("H:m"); ?> </time>
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
                            <img class="banner" src="<?= $thumb; ?>">
                            <div class="navigation"></div>
                        </div>

                        <div class="item-body">
                            <?= the_category() ?>
                            <h3 class="title"><?= get_the_title(); ?></h3>
                            <p class="post-summary"><?= get_the_excerpt(); ?></p>

                            <div class="author">
                            <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" class="avatar">
                                <p class="name"><?= get_the_author(); ?></p>
                                <time> <?php the_time("d/m/Y");  ?> às <?= the_time("H:m"); ?> </time>
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
                                    'posts_per_page' => $new_val_count_posts_sidebar-1,
                                    'post__not_in' => [$post_id_page->ID]
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
                                    'posts_per_page' => $new_val_count_posts_sidebar-1,
                                    'post__not_in' => [$post_id_page->ID]
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
                                    'posts_per_page' => $new_val_count_posts_sidebar-1,
                                    'post__not_in' => [$post_id_page->ID]
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
                                    'posts_per_page' => $new_val_count_posts_sidebar-1,
                                    'post__not_in' => [$post_id_page->ID]
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
                        default:
                            if($option_pina_sidebar == 'yes'){
                                $args_last_post = [
                                    'post_type' => 'post',
                                    'order' => 'DESC',
                                    'meta_key' => 'wpb_post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'posts_per_page' => $new_val_count_posts_sidebar-1,
                                    'post__not_in' => [$post_id_page->ID]
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
                        $args_pinado_post_sidebar = [
                            'post_type' => 'post',
                            'p' => $post_id_page->ID
                        ];
                        $result_pinado_post_sidebar = new WP_Query($args_pinado_post_sidebar);

                        if($result_pinado_post_sidebar->have_posts()): while($result_pinado_post_sidebar->have_posts()):
                            $result_pinado_post_sidebar->the_post();
                    ?>
                        <div class="most-read-item">
                            <div class="item-number"></div>
                            <div class="item-body">
                                <h4 class="title"><?php the_title(); ?></h4>
                                <div class="author">Por <?= get_the_author(); ?> - <?php the_time('j \d\e F \d\e Y');  ?></div>
                                <a href="<?php the_permalink(); ?>" class="item-link"></a>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_query(); wp_reset_postdata(); ?>
                    <?php endif; ?>
                    <?php
                        if($option_sidebar_post_count > 1 || $option_pina_sidebar == 'no'):
                        while ( $popularpost->have_posts() ) : $popularpost->the_post();            
                    ?>

                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title"><?php the_title(); ?></h4>
                            <div class="author">Por <?= get_the_author(); ?> - <?php the_time('j \d\e F \d\e Y');  ?></div>
                            <a href="<?php the_permalink(); ?>" class="item-link"></a>
                        </div>
                    </div>

                    <?php endwhile; endif; ?> 

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

        <main>
            <section id="latest-posts">
                <h2>Últimas postagens</h2>
                <div class="tab">
                    <?php
                        $terms = get_terms([
                            'taxonomy' => 'category',
                            'hide_empty' => false
                        ]);
                        foreach($terms as $term){
                            echo "<h4 data-categoria='".$term->slug."'>".$term->name."</h4>";        
                        }         
                    ?>
                </div>


                <div class="content">

                    <?php if(have_posts()): while(have_posts()): the_post(); ?>

                    <div class="latest-posts-item" data-categoria="<?= get_the_category()[0]->slug; ?>">
                        <?php 
                            $thumb = get_the_post_thumbnail_url(null, 'medium');
                            $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                        ?>
                        <img class="image" src="<?= $thumb; ?>">

                        <div class="text">
                            <?= the_category() ?>
                            <h4 class="title"><?= get_the_title(); ?></h4>
                            <p class="post-summary"><?= get_the_excerpt(); ?></p>
                            <div class="author">
                                <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>">
                                <p class="name"><?= get_the_author(); ?></p>
                                <time> <?php the_time("d/m/Y");  ?> às <?= the_time("H:m"); ?> </time>
                                
                            </div>

                            <a class="link" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div>

                    <?php endwhile; endif; ?>

                </div>
                
                 
                   <!-- <button href="#" class="see-less"><?php previous_posts_link('- Voltar ');?></button 
                    <button href="#" class="see-more"><?php next_posts_link('Veja mais +'); ?></button>
                     -->
                   
                     <button href="#" class="loadmore see-more">Ver mais +</button>
               
                 
                
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