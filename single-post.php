<?php get_header(); ?>


<?php if(have_posts()): while(have_posts()): the_post(); ?>
<?php wpb_set_post_views(get_the_ID()); ?>
<style>
    /* atualizacoes */
  /* add .menu */
  nav .desktop .content .line-2 .menu {
    padding: 1.25rem 1.25rem;
    /*grid-area: line-2;*/
    /*grid-template-areas: "link-1 link-2 link-3 link-4 link-5";*/
    -webkit-box-pack: center;
    display: flex;
    justify-content: center;
    max-width: calc(var(--max-content-width) + 80px);
  }
  nav .desktop .content .line-2 .menu li{
    grid-area: link-5;
    display: flex;
    justify-content: center;
    margin: 0 75px;
  }
  /* atualizacoes */
</style>
        <main>
            <article class="article-post">
                <div class="article-head">
                    <p class="category-tag"><?= get_the_category()[0]->name; ?></p>
                    
                    <h1 style="margin-top: 0;"><?= get_the_title(); ?></h1>

                    <div class="author">
                        <?php $mail_user = strval(get_the_author_meta('user_email', false)); ?>
                        <img style="border-radius: 50%" src="<?= get_avatar_url($mail_user, '32', '', '', null) ?>">
                        <p class="name"><?= get_the_author(); ?></p>
                        <time><?= date_post(get_the_date('d-m-Y'), get_the_time('H:i:s')); ?></time>
                    </div>

                    <?php 
                        $banner_image = get_the_post_thumbnail_url(null, 'normal');
                        $banner_image == "" ? $banner_image = get_template_directory_uri().'/assets/img/thumb-default.jpg' : "";
                    ?>
                    
                    <div class="banner_single_post" style="background-image: url('<?= $banner_image; ?>');">

                    </div>
                    <!--
                    <img class="banner mobile-tablet" src="">
                    <img class="banner desktop" src="<?= get_the_post_thumbnail_url(null, 'large'); ?>">
                    -->
                </div>

                <style>
                    .article-body ul, .article-body ol{
                        margin: 64px 0;
                        margin-left: 64px;
                    }
                    .article-body ul{
                        list-style: disc;
                    }
                    .article-body ul li, .article-body ol li{
                        font-size: 1.4375rem;
                        color: var(--dark-grey);
                        line-height: .5rem;
                        margin-top: 2.1875rem;
                        margin-bottom: 2.1875rem;
                    }
                    .article-body table, .article-body table td{
                        border: 1px solid #bebebe;
                        border-collapse: collapse;
                        padding: 10px;
                        background-color: #fff;
                        font-size: 1.4375rem;
                        color: var(--dark-grey);
                    }
                    .article-body h1{
                        margin: 0;
                        padding: 0;
                        font-size: 31px;
                        line-height: 3rem;
                    }
                    .article-body h2, .article-body h2 strong,
                    .article-body h3, .article-body h3 strong,
                    .article-body h4, .article-body h4 strong,
                    .article-body h5, .article-body h5 strong,
                    .article-body h6, .article-body h6 strong{
                        margin: 0;
                        padding: 0;
                        font-size: 23px;
                        line-height: 2.2rem;
                    }
                    .article-body h1::after, .article-body h2::after{
                        display: none;
                    }
                    .article-body a{
                        color: #1592E6;
                        text-decoration: underline;
                    }
                    .article-body img{
                        width: 100%;
                        height: auto;
                    }
                    .article-body blockquote{
                        background-color: #fff;
                        border: 1px solid #ccc;
                        padding: 20px;
                        display: flex;
                        justify-content: center;
                        flex-wrap: wrap;
                    }
                    .article-body blockquote .head-quote{
                        width: 100%;
                        display: flex;
                        justify-content: space-between;
                    }
                    .article-body blockquote .head-quote img{
                        width: 32px;
                        margin: 0;
                    }
                    .article-body blockquote p{
                        text-align: center;
                        width: 100%;
                        margin: 12px;
                        opacity: 0.8;
                    }
                    .article-body blockquote cite{
                        margin: 10px auto;
                        text-align: center;
                        width: 100%;
                        color: #565656;
                        font-weight: 600;
                        font-size: 1.1em;
                    }
                    @media(max-width: 768px){
                        .article-body h2, .article-body h2 strong,
                        .article-body h3, .article-body h3 strong,
                        .article-body h4, .article-body h4 strong,
                        .article-body h5, .article-body h5 strong,
                        .article-body h6, .article-body h6 strong{
                            font-size: 18px;
                        }
                    }
                    @media(max-width: 415px){
                        .article-body ul, .article-body ol{
                            margin: 24px 0;
                            margin-left: 18px;
                        }
                        .article-body ul li, .article-body ol li{
                            font-size: 1.125rem;
                            line-height: .475rem;
                            color: var(--dark-grey);
                            margin-top: 1.5625rem;
                            margin-bottom: 1.5625rem;
                        }
                        .article-body table, .article-body table td{
                            padding: 10px;
                            font-size: 1rem;
                        }
                        .article-body h1{
                        margin: 0;
                        padding: 0;
                        font-size: 23px;
                        }
                        .article-body h2, .article-body h2 strong,
                        .article-body h3, .article-body h3 strong,
                        .article-body h4, .article-body h4 strong,
                        .article-body h5, .article-body h5 strong,
                        .article-body h6, .article-body h6 strong{
                            margin: 0;
                            padding: 0;
                            font-size: 16px;
                        }
                        .article-body blockquote .head-quote img{
                            width: 24px;
                        }
                    }
                    @media(max-width: 375px){
                        .article-body h2, .article-body h2 strong,
                        .article-body h3, .article-body h3 strong,
                        .article-body h4, .article-body h4 strong,
                        .article-body h5, .article-body h5 strong,
                        .article-body h6, .article-body h6 strong{
                            font-size: 14px;
                        }
                    }
                </style>

                <div class="article-body">
                    <style>
                        .nl-container p{
                            padding: 0!important;
                            margin: 0!important;
                        }
                    </style>
                    <?php the_content(); ?>

                   <script>
                       const quotes = document.querySelectorAll('.article-body blockquote');

                        quotes.forEach((item) => {
                            item.insertAdjacentHTML('afterbegin', '<div class="head-quote"><img src="<?= get_template_directory_uri(); ?>/assets/img/icons/quote-left.png"><img src="<?= get_template_directory_uri(); ?>/assets/img/icons/quote-right.png"></div>');
                        });
                   </script>
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
                               
                                <time> <?= date_post(get_the_date('d-m-Y'), get_the_time('H:i:s')); //the_date('j \d\e M \d\e Y');  ?> </time>
                                
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
            <style>
                .link_whatsapp{
                    position: absolute;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }
            </style>
            <section id="whatsapp" style="position: relative;">
                <p>Receba nossas recomendações de saúde direto no celular.</p>
                <a href="" class="btn btn-whatsapp">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/whatsapp.svg">
                    Whatsapp Doutor Nature
                </a>
                <a class="link_whatsapp" href="<?= get_option('show_rodape_whatsapp'); ?>"></a>
            </section>
        </main>
        <script>
            const pop = document.querySelector('.strip');
            const pop_show = pop.style.display;
            let pop_height = pop.clientHeight;
            const art = document.querySelector("main article.article-post");
            art.setAttribute('style','');
            art.style.paddingTop = pop_height+"px";
            console.log(pop_height);
        </script>
<?php endwhile; endif; ?>
<?php get_footer(); ?>