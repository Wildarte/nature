<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title><?php bloginfo('name'); ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
            $page_type_r;
            if(is_single()):
                $page_type_r = get_template_directory_uri() . '/assets/css/pagina-interna.css';
            else:
                $page_type_r = get_template_directory_uri() . '/assets/css/home.css';
            endif;
            
        ?>
        <link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/reseter.css">
        <link rel="stylesheet" href="<?= $page_type_r; ?>">
        <style>
            .space-banner-post{
                max-width: 810px;
                height: 320px;
                background-color: #ccc;
                border-radius: 16px;
                overflow: hidden;
            }
        </style>
        <!-- wp header -->
        <?php wp_head(); ?>
        <!-- wp header -->
    </head>


    <body class="with-sidebar topbar-open">
        <nav>
            <div class="strip">
                <p class="close">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/close-top.png">
                    <span>Fechar</span>
                </p>
                <span class="label">novidade</span>
                <a href="#" class="link">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/fire-top.png" class="fire">
                    Visite nosso site de suplementos
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/arrow-right.svg">
                </a>
            </div>

            <div class="desktop">
                <div class="content">
                    <div class="line-1">
                        <form action="<?= home_url(); ?>" class="search-form">
                            <label class="label-search">
                                <input type="search" class="search" name="s" placeholder="Buscar">
                            </label>

                            <button type="submit">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/search.png">
                            </button>
                        </form>
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/logos/dr-nature.svg" class="logo">
                        <a href="<?= get_option('link_acesse_conta'); ?>" class="login"><img src="<?= get_template_directory_uri(); ?>/assets/img/icons/login.svg"> Acesse sua conta</a>
                    </div>

                    <hr style="height: 0.0625rem; margin: 0; padding: 0; border: 0; border-top: 0.0625rem solid #E6E8E9;">

                    <div class="line-2">

                        <?php
                            $args = array(
                                'menu' => 'menu principal',
                                'theme_location' => 'menu-principal',
                                'container' => false
                            );
                            wp_nav_menu( $args );
                        ?>
                        <!-- 
                        <a class="page-links" href="#">Protocolos</a>
                        <a class="page-links" href="#">Livraria</a>
                        <a class="page-links" href="#">Conteúdo</a>
                        <a class="page-links" href="#">Contato</a>
                        <a class="page-links" href="#">Quem Somos</a>
                         -->
                    </div>
                </div>
            </div>

            <div class="mobile">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/menu.svg" class="menu-toggler">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/logos/dr-nature.svg" class="nav-logo">
                <a href="#" class="login">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/login.svg">
                    Entrar
                </a>

                <div class="sidebar closed">
                    <div class="content">
                        <div class="logo">
                            <img class="logo-sidebar" src="<?= get_template_directory_uri(); ?>/assets/img/logos/dr-nature.svg">
                            <img class="menu-toggler close" src="<?= get_template_directory_uri(); ?>/assets/img/icons/close.svg">
                        </div>

                        <ul>
                            <li>
                                <form action="<?= home_url(); ?>" class="search-form">
                                    <label class="label-search">
                                        <input type="search" name="s" class="search" placeholder="Buscar">
                                    </label>

                                    <button type="submit">
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/icons/search.png">
                                    </button>
                                </form>
                            </li>
                            <?php
                                $args = array(
                                    'menu' => 'menu principal',
                                    'theme_location' => 'menu-principal',
                                    'container' => false
                                );
                                wp_nav_menu( $args );
                            ?>

                            <!-- 
                            <li><a href="#">Protocolos</a></li>
                            <li><a href="#">Livraria</a></li>
                            <li><a href="#">Conteúdo</a></li>
                            <li><a href="#">Quem Somos</a></li>
                            <li><a href="#">Contato</a></li>
                             -->
                        </ul>
                    </div>
                    <div class="bg"></div>
                </div>
            </div>
        </nav>