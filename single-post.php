<?php get_header(); ?>


<?php if(have_posts()): while(have_posts()): the_post(); ?>
<?php wpb_set_post_views(get_the_ID()); ?>
        <main>
            <article>
                <div class="article-head">
                    <p class="category-tag">Diário da Saúde Natural</p>
                    
                    <h1><?= get_the_title(); ?></h1>

                    <div class="author">
                        <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                        <img style="border-radius: 50%" src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>">
                        <p class="name"><?= get_the_author(); ?></p>
                        <time><?= the_date();  ?> às <?= the_time(); ?></time>
                    </div>

                    <img class="banner mobile-tablet" src="<?= get_the_post_thumbnail_url(null, 'medium'); ?>">
                    <img class="banner desktop" src="<?= get_the_post_thumbnail_url(null, 'large'); ?>">
                </div>

                <div class="article-body">
                    <style>
                        .nl-container p{
                            padding: 0!important;
                            margin: 0!important;
                        }
                    </style>
                    <?php the_content(); ?>

                   
                </div>
            </article>
    
            <section id="related-posts">
                
                <?php

                    

                    //$custom_indica armazena o valor de SIM ou NAO se o usuario optou por escolher se quer configurar a indicação dos posts
                    $custom_indica = get_post_meta(get_the_ID(), 'indica_post_myself', true);
                
                    //armazena a(s) categorias do post
                    $category_post = get_the_category();
                  

                    //se a variavel que armazena a escolha do usuário sobre a indicação de posts estiver vazia ou com o valor "no", entao os posts de indicação serão listados por categoria
                    if(empty($custom_indica) || $custom_indica == "no"):
                       
                        if(count($category_post) >= 1):
                            
                            switch(count($category_post)):
                                
                                case 1:
                                    
                                    $args_query = [
                                        'post_type' => 'post',
                                        'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                        'category_name' => $category_post[0]->slug,
                                        'order' => 'DESC',
                                        'posts_per_page' => 3
                                    ];

                                    if(!verifa_posts($args_query))://caso nao retorne nenhum post a query recebe novos argumentos
                                        
                                        $args_query = [
                                            'post_type' => 'post',
                                            'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                            'order' => 'DESC',
                                            'posts_per_page' => 3
                                        ];
                                    else:
                                       
                                    endif;
                                break;
                                case 2:
                                    $args_query = [
                                        'post_type' => 'post',
                                        'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                        'tax_query' => [
                                            'relation' => 'or',[
                                                'taxonomy' => 'category',
                                                'field' => 'slug',
                                                'terms' => [
                                                    $category_post[0]->slug,
                                                    $category_post[1]->slug
                                                ]
                                            ]
                                        ],
                                        'order' => 'DESC',
                                        'posts_per_page' => 3
                                    ];
                                break;
                                case 3:
                                    $args_query = [
                                        'post_type' => 'post',
                                        'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                        'tax_query' => [
                                            'relation' => 'or',[
                                                'taxonomy' => 'category',
                                                'field' => 'slug',
                                                'terms' => [
                                                    $category_post[0]->slug,
                                                    $category_post[1]->slug,
                                                    $category_post[2]->slug
                                                ]
                                            ]
                                        ],
                                        'order' => 'DESC',
                                        'posts_per_page' => 3
                                    ];
                                break;
                                default:
                                    $args_query = [
                                        'post_type' => 'post',
                                        'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                        'category_name' => $category_post[0]->slug,
                                        'order' => 'DESC',
                                        'posts_per_page' => 3
                                    ];
                                endswitch;
                            
                        else:
                            $args_query = [
                                'post_type' => 'post',
                                'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                'order' => 'DESC',
                                'posts_per_page' => 3
                            ];
                        endif;
                       

                    elseif($custom_indica == "yes"):
                        
                        $opcao_listagem = get_post_meta(get_the_ID(), 'meta_indica_select', true);
                        
                        switch($opcao_listagem):

                            case "lastPost":
                                $args_query = [
                                    'post_type' => 'post',
                                    'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                    'order' => 'DESC',
                                    'posts_per_page' => 3
                                ];
                            break;
                            case "category":
                                $args_query = [
                                    'post_type' => 'post',
                                    'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                    'category_name' => get_post_meta(get_the_ID(), 'meta_indica_categoria', true),
                                    'order' => 'DESC',
                                    'posts_per_page' => 3
                                ];
                            break;
                            case "keyword":
                                $search_keyword = get_post_meta(get_the_ID(), 'meta_indica_keyword', true);
                                $args_query = [
                                    'post_type' => 'post',
                                    'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                    's' => $search_keyword,
                                    'posts_per_page' => 3
                                ];
                            break;
                            case "moreread":
                                $args_query = array( 
                                    'posts_per_page' => 3,
                                    'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                    'meta_key' => 'wpb_post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'order' => 'DESC' );
                            break;
                            default:
                                $args_query = [
                                    'post_type' => 'post',
                                    'post__not_in' => [get_the_ID()],//especifica o post que não é para ser recuperado, e usamos o get_the_ID para pegar o post pelo ID
                                    'category_name' => get_post_meta(get_the_ID(), 'meta_indica_categoria', true),
                                    'order' => 'DESC',
                                    'posts_per_page' => 3
                                ];


                        endswitch;

                    endif;
                    
                ?>
                
                <h2>Postagens relacionadas</h2>

                <div class="related-posts-container">

                    <?php
                        
                        $the_resp = new WP_Query($args_query);
                    
                        if($the_resp->have_posts()):
                            
                            while($the_resp->have_posts()): 
                                $the_resp->the_post();
                    ?>
                    <div class="post">
                        <div class="image">
                            <?php 
                                $thumb_post_rel = get_the_post_thumbnail_url(null, 'thumbnail');
                                $thumb_post_rel == "" ? $thumb_post_rel = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                            ?>
                            <img src="<?= $thumb_post_rel ?>">
                        </div>
                        <div class="text">
                            <h4 class="title"><?php the_title(); ?></h4>
                            <div class="author">
                                <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                                <img style="border-radius: 50%" src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>" class="avatar">
                                <p class="name"><?= get_the_author(); ?></p>
                                <time> <?= the_date();  ?> às <?= the_time(); ?> </time>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="link"></a>
                    </div>
                    <?php
                        endwhile; else: echo "nenhum post encontrado"; endif;
                        wp_reset_query(); wp_reset_postdata();
                    ?>

                </div>
            </section>

            <section id="whatsapp">
                <p>Receba nossas recomendações de saúde direto no celular.</p>
                <a href="<?= get_option('show_rodape_whatsapp'); ?>" class="btn btn-whatsapp">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/whatsapp.svg">
                    Whatsapp da Doutor Nature
                </a>
            </section>
        </main>

<?php endwhile; endif; ?>
<?php get_footer(); ?>