<?php get_header(); $cat = get_category(get_query_var('cat'))->name; ?>

        <aside>
            <?php include 'inc/asideCategory.php'; ?>

            <section id="products">
                <div class="all-suplements">
                    <img src="./assets/img/products/vital-4k-sidebar.png">
                    <h4>A família Doutor Nature está crescendo...</h4>
                    <p>Conheça a <b class="orange">Nature Vitaminas</b>! <br>
                        Todos os suplementos nutricionais que você confia agora estão de casa nova!</p>
                    <button class="btn btn-blue">Saiba Mais</button>
                    <a href="#" class="link"></a>
                </div>
            </section>
        </aside>

        <h1><?= $cat; ?></h1>
        
        <main>
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
                            <p class="post-summary"><?= get_the_excerpt(); ?></p>
                            <div class="author">
                                <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                <img src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>">
                                <p class="name"><?= get_the_author(); ?></p>
                                <time> <?php the_time("d/m/Y");  ?> às <?= the_time("H:m"); ?> </time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <?php endwhile; endif; ?>

                    <!-- 
                    <div class="latest-posts-item" data-categoria="viva-sem-dores">
                        <img class="image" src="./assets/img/news/2.png">

                        <div class="text">
                            <p class="category-tag">Viva sem dores</p>
                            <h4 class="title">Descoberta sobre os ossos revela elo perdido no equilíbrio dos minerais</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="./assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="carta-ao-homem">
                        <img class="image" src="./assets/img/news/3.png">

                        <div class="text">
                            <p class="category-tag">Carta ao Homem</p>
                            <h4 class="title">Segredo da “molécula da dor ”desliga o sofrimento crônico</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="./assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="saude-natural">
                        <img class="image" src="./assets/img/news/1.png">

                        <div class="text">
                            <p class="category-tag">Diário da Saúde Natural</p>
                            <h4 class="title">Descoberta sobre os ossos revela elo perdido no equilíbrio dos minerais</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="./assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="viva-sem-dores">
                        <img class="image" src="./assets/img/news/2.png">

                        <div class="text">
                            <p class="category-tag">Viva sem dores</p>
                            <h4 class="title">Suas articulações estão doloridas… e secas? resolva com isso</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="./assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>
                     -->

                </div>

                <div class="navigation-posts">
                    <button href="#" class="see-less"><?php previous_posts_link('- Voltar ');?></button>
                    <button href="#" class="see-more"><?php next_posts_link('Veja mais +'); ?></button>
                 </div>
            </section>
        </main>

        <section id="cards">
            <div class="card">
                <div class="card-image">
                    <img src="./assets/img/icons/padlock.svg">
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
                <img src="./assets/img/products/vital-4k.png">
                <a href="#" class="link"></a>
            </div>
        </section>


<?php get_footer(); ?>