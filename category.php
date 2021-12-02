<?php get_header(); $cat = get_category(get_query_var('cat'))->name; $cat_slug = get_category(get_query_var('cat'))->slug ?>

        <aside>
            <?php include 'inc/asideCategory.php'; ?>

            <?php 
                $show_ad_sidebar = get_option('show_onoff_ads_sidebar_category');
                if($show_ad_sidebar != "on"):
                    include 'inc/adsidebar.php';
                endif;
            ?>
        </aside>

        <h1><?= $cat; ?></h1>
        
        <main style="width:100%">
            <section id="latest-posts" style="background-color: transparent;">
                <!-- 
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
                -->

                <div class="content">
                    <?php

                        $args_cat = [
                            'category_name' => $cat
                        ];
                        $result_cat = new WP_Query($args_cat);

                        if($result_cat->have_posts()): while($result_cat->have_posts()): $result_cat->the_post();

                    ?>
                    <div class="latest-posts-item" data-categoria="<?= get_the_category()[0]->slug ?>">
                        <?php 
                            $thumb = get_the_post_thumbnail_url(null, 'medium');
                            $thumb == "" ? $thumb = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                        ?>
                        <img class="image" src="<?= $thumb; ?>">

                        <div class="text">
                            <?php the_category(); ?>
                            <h4 class="title"><?php the_title(); ?></h4>
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
                                <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>">
                                <p class="name"><?= get_the_author(); ?></p>
                                <time> <?php the_time("d/m/Y");  ?> às <?= the_time("H:m"); ?> </time>
                            </div>

                            
                        </div>
                        <a class="link" href="<?php the_permalink(); ?>"></a>
                    </div>

                    <?php endwhile; endif; ?>

                </div>
                
                <?php
                    $btn_morepost = get_option('show_button_loadpost_notpost');
                    $msg_button = get_option('show_button_loadpost_msg');

                    if($btn_morepost == "hide_buttonpost"): 
                ?>
                <button onclick='more_post("category","<?= $cat_slug; ?>")' class="loadmore see-more"><span id="text-button-load"><?= get_option('show_text_button_loadpost'); ?></span> <span style="display: none;" class="c-loader"></span> </button>
                
                <?php else: ?>

                <button onclick='more_post2("category","<?= $cat_slug; ?>", "<?= $msg_button; ?>")' class="loadmore see-more"><span id="text-button-load"><?= get_option('show_text_button_loadpost'); ?></span> <span style="display: none;" class="c-loader"></span> </button>

                <?php endif; ?>

            </section>
        </main>

        <section id="cards">
            <?php 
                $show_ad_footer = get_option('show_onoff_ads_footer_category');
                if($show_ad_footer != "on"):
                    include 'inc/adfooter.php';
                endif;
            ?>

            <?php 
                $show_ad_sidebar = get_option('show_onoff_ads_sidebar_category');
                if($show_ad_sidebar != "on"):
                    include 'inc/allsuplements.php';
                endif;
            ?>
        </section>


<?php get_footer(); ?>