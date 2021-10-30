<?php
    get_header();
?>

        <header>
            <h2 class="main-title">Conteúdo</h2>
            <div class="news-carousel">
                <div class="carousel-wrapper">

                    

                    <!--  -->
                    <div class="news-item">
                        <div class="item-head">
                            <img class="banner" src="<?= get_template_directory_uri(); ?>/assets/img/carousel/1.png">
                            <div class="navigation"></div>
                        </div>

                        <div class="item-body">
                            <p class="category-tag">Diário da Saúde Natural</p>
                            <h3 class="title">Suas articulações estão doloridas? resolva com isso</h3>
                            <p class="post-summary">Os cuidados de saúde na época do coronavírus são como uma paisagem estranha. dos de saúde na época do coronavírus são como uma paisagem estranha E não...</p>

                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png" class="avatar">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a href="#"></a>
                        </div>
                    </div>

                    <div class="news-item">
                        <div class="item-head">
                            <img class="banner" src="<?= get_template_directory_uri(); ?>/assets/img/carousel/1.png">
                            <div class="navigation"></div>
                        </div>

                        <div class="item-body">
                            <p class="category-tag">Diário da Saúde Natural</p>
                            <h3 class="title">Suas articulações estão doloridas? resolva com isso</h3>
                            <p class="post-summary">Os cuidados de saúde na época do coronavírus são como uma paisagem estranha. dos de saúde na época do coronavírus são como uma paisagem estranha E não...</p>

                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png" class="avatar">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a href="#"></a>
                        </div>
                    </div>

                    <div class="news-item">
                        <div class="item-head">
                            <img class="banner" src="<?= get_template_directory_uri(); ?>/assets/img/carousel/1.png">
                            <div class="navigation"></div>
                        </div>

                        <div class="item-body">
                            <p class="category-tag">Diário da Saúde Natural</p>
                            <h3 class="title">Suas articulações estão doloridas? resolva com isso</h3>
                            <p class="post-summary">Os cuidados de saúde na época do coronavírus são como uma paisagem estranha. dos de saúde na época do coronavírus são como uma paisagem estranha E não...</p>

                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png" class="avatar">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a href="#"></a>
                        </div>
                    </div>

                    <div class="news-item">
                        <div class="item-head">
                            <img class="banner" src="<?= get_template_directory_uri(); ?>/assets/img/carousel/1.png">
                            <div class="navigation"></div>
                        </div>

                        <div class="item-body">
                            <p class="category-tag">Diário da Saúde Natural</p>
                            <h3 class="title">Suas articulações estão doloridas? resolva com isso</h3>
                            <p class="post-summary">Os cuidados de saúde na época do coronavírus são como uma paisagem estranha. dos de saúde na época do coronavírus são como uma paisagem estranha E não...</p>

                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png" class="avatar">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a href="#"></a>
                        </div>
                    </div>
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
                    //busca pelos posts mais lidos
                    $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
                    if($popularpost->have_posts()):
                ?>
            <section id="most-read">
                <h2>Artigos mais lidos</h2>

                <div class="most-read-news">
                    <?php
                        while ( $popularpost->have_posts() ) : $popularpost->the_post();            
                    ?>

                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title"><?php the_title(); ?></h4>
                            <div class="author"><?= get_the_author(); ?> - <?= the_date(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="item-link"></a>
                        </div>
                    </div>

                    <?php endwhile; endif; wp_reset_query(); wp_reset_postdata(); ?>
                    
                    <!-- 
                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title">Se Prepare Para Uma TSUNAMI Sexual Com Esta "Erva da Intimidade"</h4>
                            <div class="author">Por Dr. Rafael Freitas - 20 de junho de 2021</div>
                            <a href="#" class="item-link"></a>
                        </div>
                    </div>

                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title">Condição GRAVE Afeta 90% dos Homens Acima de 60 Anos</h4>
                            <div class="author">Por Dr. Rafael Freitas - 20 de junho de 2021</div>
                            <a href="#" class="item-link"></a>
                        </div>
                    </div>

                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title">EXPULSE a Dor da Artrite Com Esta Alternativa “Angelical”</h4>
                            <div class="author">Por Dr. Rafael Freitas - 20 de junho de 2021</div>
                            <a href="#" class="item-link"></a>
                        </div>
                    </div>

                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title">DOMINE a Dor da Artrite Com Esta Frutinha</h4>
                            <div class="author">Por Dr. Rafael Freitas - 20 de junho de 2021</div>
                            <a href="#" class="item-link"></a>
                        </div>
                    </div>

                    <div class="most-read-item">
                        <div class="item-number"></div>
                        <div class="item-body">
                            <h4 class="title">DOMINE a Dor da Artrite Com Esta Frutinha</h4>
                            <div class="author">Por Dr. Rafael Freitas - 20 de junho de 2021</div>
                            <a href="#" class="item-link"></a>
                        </div>
                    </div>
                     -->

                </div>
            </section>
            

            <section id="categories">
                <h2>Explore por categoria</h2>
                <div class="categories">

                <?php
                    $terms = get_terms([
                        'taxonomy' => 'category',
                        'hide_empty' => false
                    ]);
                    foreach($terms as $term){
                        echo "<a class='category' href='". get_home_url() ."/category/". $term->name. "'>".$term->name."<img src='".get_template_directory_uri()."/assets/img/icons/next.svg'></a>";        
                    }         
                ?>

                    <!-- 
                    <a class="category" href="#">
                        Diário da Saúde Natural <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/next.svg">
                    </a>

                    <a class="category" href="#">
                        Viva sem Dores <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/next.svg">
                    </a>

                    <a class="category" href="#">
                        Carta ao homem <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/next.svg">
                    </a>
                     -->
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
            <section id="latest-posts">
                <h2>Últimas postagens</h2>
                <div class="tab">
                    <h4 data-categoria="saude-natural">Saúde <br> Natural</h4>
                    <h4 data-categoria="viva-sem-dores" class="active">Viva <br> Sem Dores</h4>
                    <h4 data-categoria="carta-ao-homem">Carta ao <br> Homem</h4>
                </div>


                <div class="content">

                    <?php if(have_posts()): while(have_posts()): the_post(); ?>

                    <div class="latest-posts-item" data-categoria="saude-natural">
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
                                <time> <?= the_date();  ?> às <?= the_time(); ?> </time>
                                
                            </div>

                            <a class="link" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div>

                    <?php endwhile; endif; ?>

                    <!-- 
                    <div class="latest-posts-item" data-categoria="viva-sem-dores">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/2.png">

                        <div class="text">
                            <p class="category-tag">Viva sem dores</p>
                            <h4 class="title">Descoberta sobre os ossos revela elo perdido no equilíbrio dos minerais</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="carta-ao-homem">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/3.png">

                        <div class="text">
                            <p class="category-tag">Carta ao Homem</p>
                            <h4 class="title">Segredo da “molécula da dor ”desliga o sofrimento crônico</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>
                    <div class="latest-posts-item" data-categoria="saude-natural">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/1.png">

                        <div class="text">
                            <p class="category-tag">Diário da Saúde Natural</p>
                            <h4 class="title">Suas articulações estão doloridas… e secas? resolva com isso</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="viva-sem-dores">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/2.png">

                        <div class="text">
                            <p class="category-tag">Viva sem dores</p>
                            <h4 class="title">Descoberta sobre os ossos revela elo perdido no equilíbrio dos minerais</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="carta-ao-homem">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/3.png">

                        <div class="text">
                            <p class="category-tag">Carta ao Homem</p>
                            <h4 class="title">Segredo da “molécula da dor ”desliga o sofrimento crônico</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>
                    <div class="latest-posts-item" data-categoria="saude-natural">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/1.png">

                        <div class="text">
                            <p class="category-tag">Diário da Saúde Natural</p>
                            <h4 class="title">Suas articulações estão doloridas… e secas? resolva com isso</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="viva-sem-dores">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/2.png">

                        <div class="text">
                            <p class="category-tag">Viva sem dores</p>
                            <h4 class="title">Descoberta sobre os ossos revela elo perdido no equilíbrio dos minerais</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>

                    <div class="latest-posts-item" data-categoria="carta-ao-homem">
                        <img class="image" src="<?= get_template_directory_uri(); ?>/assets/img/news/3.png">

                        <div class="text">
                            <p class="category-tag">Carta ao Homem</p>
                            <h4 class="title">Segredo da “molécula da dor ”desliga o sofrimento crônico</h4>
                            <p class="post-summary">Se chegar ao ponto em que você não consegue mais “se virar” como conseguia… Seu médico pode começar a falar sobre a ideia de uma cirurgia reconstrutora de articulações.</p>
                            <div class="author">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/doctors/rafael-avatar.png">
                                <p class="name">Dr. Rafael Freitas</p>
                                <time>Há 2 horas</time>
                            </div>

                            <a class="link" href="#"></a>
                        </div>
                    </div>
                </div>
                 -->
                 <div class="navigation-posts">
                    <button href="#" class="see-less"><?php previous_posts_link('- Voltar ');?></button>
                    <button href="#" class="see-more"><?php next_posts_link('Veja mais +'); ?></button>
                 </div>
                
            </section>
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