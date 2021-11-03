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

            <section id="products">
                <div class="all-suplements">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/products/vital-4k-sidebar.png">
                    <h4>A família Doutor Nature está crescendo...</h4>
                    <p>Conheça a <b class="orange">Nature Vitaminas</b>! <br>
                        Todos os suplementos nutricionais que você confia agora estão de casa nova!</p>
                    <button class="btn btn-blue">Saiba Mais</button>
                    <a href="#" class="link"></a>
                </div>
            </section>

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
                

                <div class="navigation-posts">
                    <button href="#" class="see-less"><?php previous_posts_link('- Voltar ');?></button>
                    <button href="#" class="see-more"><?php next_posts_link('Veja mais +'); ?></button>
                </div>

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
                

                <div class="navigation-posts">
                    <button href="#" class="see-less"><?php previous_posts_link('- Voltar ');?></button>
                    <button href="#" class="see-more"><?php next_posts_link('Veja mais +'); ?></button>
                </div>

            </section>

            <?php endif; ?>
        </main>

        <section id="cards">
            <div class="card">
                <div class="card-image">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/padlock.svg">
                </div>
                <div class="card-text">
                    <h4 class="title">Um segredo super simples para fortalecer a imunidade.</h4>
                    <p>Este segredo foi descoberto por um renomado cientista brasileiro. E agora ele está compartilhando um vídeo com o passo a passo de como fazer em casa.</p>
                </div>
                <button class="btn">Assista agora</button>
                <a href="#" class="link"></a>
            </div>

            <div class="all-suplements">
                <h4>A família Doutor Nature está crescendo...</h4>
                <p>Conheça a <b class="orange">Nature Vitaminas</b>! Todos os suplementos nutricionais que você confia agora estão de casa nova!</p>
                <button class="btn btn-blue">Saiba mais</button>
                <img src="<?= get_template_directory_uri(); ?>/assets/img/products/vital-4k.png">
                <a href="#" class="link"></a>
            </div>
        </section>


<?php get_footer(); ?>