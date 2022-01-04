<?php get_header(); $s = $_GET['s'];?>
<style>
    #latest-posts{
        padding-top: 60px;
    }
    @media(max-width: 540px){
        #latest-posts{
        padding-top: 0px;
    }
    }
</style>
        <aside>
            <section id="categories">
                <h2 style="margin-top: unset;">Explore por categoria</h2>
                <div class="categories">

                <?php
                    $terms = get_terms([
                        'taxonomy' => 'category',
                        'hide_empty' => false,
                        'orderby' => 'term_id'
                    ]);
                    foreach($terms as $term){
                        $link_icon = "";
                        switch($term->slug):
                            case "carta-ao-homem":
                                $link_icon = "sexo-masculino.png";
                            break;
                            case "saude-natural":
                                $link_icon = "folha-delineada-forma-natural.png";
                            break;
                            case "viva-sem-dores":
                                $link_icon = "coluna.png";
                            break;
                            default:
                                echo "";
                        endswitch;
                            ?>
                        <a class='category <?= $current_cat[0]->name == $term->name ? 'active' : '' ?>' href='<?= get_category_link($term->term_id); ?>'><img class="icon_category" src="<?= get_template_directory_uri() ?>/assets/img/icons/<?= $link_icon; ?>"><span><?= $term->name; ?></span><img class="icon_next" src='<?= get_template_directory_uri(); ?>/assets/img/icons/next.svg'></a>      
                   <?php }         
                ?>

                </div>
            </section>

            <?php 
                $show_ad_sidebar = get_option('show_onoff_ads_sidebar_search');
                if($show_ad_sidebar != "on"):
                    include 'inc/adsidebar.php';
                endif;
            ?>

        </aside>

        <main style="width: 100%;">

        <?php

            $args_query = [
                's' => $s
            ];

            $the_resp = new WP_Query($args_query);
            $count_posts = $the_resp->found_posts;
            
            
            if($count_posts > 0): ?>

            <section id="search-results" s>
                <h2>Resultados da busca por “<?= $s; ?>”</h2>
                <p>Foram encontrados <b class="results-count"><?= $count_posts; ?></b> posts para sua pesquisa.</p>
            </section>

            <section id="latest-posts" style="background-color: transparent;">
                

                <div class="content">

                    <?php if($the_resp->have_posts()): while($the_resp->have_posts()): $the_resp->the_post(); ?>

                    <div class="latest-posts-item" data-categoria="<?= get_the_category()[0]->slug; ?>">
                        <?php 
                            $thumb = get_the_post_thumbnail_url(null, 'thumbnail');
                            $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                        ?>
                        <img class="image" src="<?= $thumb; ?>">

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
                                <time> <?php echo date_post(get_the_date('d-m-Y'), get_the_time('H:i:s')); ?></time>
                            </div>

                            
                        </div>
                    </div>

                    <?php
                        endwhile; endif;
                        wp_reset_query(); wp_reset_postdata();
                    ?>
                    
                </div>
               
                <?php
                    $btn_morepost = get_option('show_button_loadpost_notpost');
                    $msg_button = get_option('show_button_loadpost_msg');

                    if($btn_morepost == "hide_buttonpost"): 
                ?>
                <button onclick="more_post('search', '<?= $s; ?>')" class="loadmore see-more"><span id="text-button-load"><?= get_option('show_text_button_loadpost'); ?></span> <span style="display: none;" class="c-loader"></span> </button>
                
                <?php else: ?>

                <button onclick="more_post2('search', '<?= $s; ?>', '<?= $msg_button; ?>')" class="loadmore see-more"><span id="text-button-load"><?= get_option('show_text_button_loadpost'); ?></span> <span style="display: none;" class="c-loader"></span> </button>

                <?php endif; ?>

            </section>

            <?php 
            
                else:

                $args_last_post = [
                    'post_type' => 'post',
                    'order' => 'DESC'
                ];
                $the_resp = new WP_Query($args_last_post);
                
            ?>

            <section id="search-results">
                <h2>Não encontrados resultados para “<?= $s; ?>”</h2>
                <p>Mas talvez você goste desse conteúdo:</p>
            </section>

            <section id="latest-posts"  style="background-color: transparent;">
                

                <div class="content">
                        
                    <?php if($the_resp->have_posts()): while($the_resp->have_posts()): $the_resp->the_post(); ?>

                    <div class="latest-posts-item" data-categoria="<?= get_the_category()[0]->slug; ?>">
                        <?php 
                            $thumb = get_the_post_thumbnail_url(null, 'thumbnail');
                            $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                        ?>
                        <img class="image" src="<?= $thumb; ?>">

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
                                <time> <?php echo date_post(get_the_date('d-m-Y'), get_the_time('H:i:s')); ?></time>
                            </div>

                            
                        </div>
                    </div>

                    <?php
                        endwhile; endif;
                        wp_reset_query(); wp_reset_postdata();
                    ?>
                    
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

            <?php endif; ?>
        </main>

        <section id="cards">
            <?php 
                $show_ad_footer = get_option('show_onoff_ads_footer_search');
                if($show_ad_footer != "on"):
                    include 'inc/adfooter.php';
                endif;
            ?>

            <?php 
                $show_ad_sidebar = get_option('show_onoff_ads_sidebar_search');
                if($show_ad_sidebar != "on"):
                    include 'inc/allsuplements.php';
                endif;
            ?>
        </section>


<?php get_footer(); ?>