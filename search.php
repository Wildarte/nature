<?php get_header(); $s = $_GET['s'];?>

        <aside>
            <section id="categories">
                <h2 style="margin-top: unset;">Explore por categoria</h2>
                <div class="categories">

                <?php
                    $terms = get_terms([
                        'taxonomy' => 'category',
                        'hide_empty' => false
                    ]);
                    foreach($terms as $term){
                        echo "<a class='category' href='". get_home_url() ."/category/". $term->slug. "'>".$term->name."<img src='".get_template_directory_uri()."/assets/img/icons/next.svg'></a>";        
                    }         
                ?>

                </div>
            </section>

            <?php 
                $show_ad_sidebar = get_option('show_onoff_ads_sidebar');
                if($show_ad_sidebar != "on"):
                    include 'inc/adsidebar.php';
                endif;
            ?>

        </aside>

        <main>

        <?php

            $args_query = [
                's' => $s
            ];

            $the_resp = new WP_Query($args_query);
            $count_posts = $the_resp->found_posts;
            
            
            if($count_posts > 0): ?>

            <section id="search-results">
                <h2>Resultados da busca por “<?= $s; ?>”</h2>
                <p>Foram encontrados <b class="results-count"><?= $count_posts; ?></b> posts para sua pesquisa.</p>
            </section>

            <section id="latest-posts">
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

                    <?php if($the_resp->have_posts()): while($the_resp->have_posts()): $the_resp->the_post(); ?>

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
                                <time> <?= the_date();  ?> às <?= the_time(); ?></time>
                            </div>

                            <a class="link" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div>

                    <?php
                        endwhile; endif;
                        wp_reset_query(); wp_reset_postdata();
                    ?>
                    
                </div>
                
                    <!--  
                    <button href="#" class="see-less"></button>
                    <button href="#" class="see-more"></button>
                    -->
                    <button href="#" class="loadmore see-more" onclick="more_post('search', '<?= $s; ?>')">Ver mais +</button>

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

            <section id="latest-posts">
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
                        
                    <?php if($the_resp->have_posts()): while($the_resp->have_posts()): $the_resp->the_post(); ?>

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
                                <time> <?= the_date();  ?> às <?= the_time(); ?></time>
                            </div>

                            <a class="link" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div>

                    <?php
                        endwhile; endif;
                        wp_reset_query(); wp_reset_postdata();
                    ?>
                    
                </div>
                
                <button href="#" class="loadmore see-more" onclick="more_post('lastPost')">Ver mais +</button>
                

            </section>

            <?php endif; ?>
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