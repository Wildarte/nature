<?php

    function nature_scripts(){
        wp_register_script('owl-carousel', get_template_directory_uri() . '/lib/owl-carousel/owl.carousel.min.js', [], false, true);
        wp_register_script('sticky-js', get_template_directory_uri() . '/lib/sticky-js/sticky.jquery.js', [], false, true);
        wp_register_script('script', get_template_directory_uri() . '/assets/js/script.js', [], false, true);
        //wp_register_script('pagina-interna', get_template_directory_uri() . '/assets/js/pagina-interna.js', [], false, true);

        wp_enqueue_script(['owl-carousel', 'sticky-js', 'script']);
    }
    add_action('wp_enqueue_scripts', 'nature_scripts');


    function nature_styles(){
        wp_register_style('owl-carousel-style', get_template_directory_uri() . '/lib/owl-carousel/owl.carousel.min.css', [], false, false);
        wp_register_style('owl-theme-style', get_template_directory_uri() . '/lib/owl-carousel/owl.theme.default.min.css', [], false, false);
        //wp_register_style('reseter', get_template_directory_uri() . '/assets/css/reseter.css', [], false, false);
        //wp_register_style('home', get_template_directory_uri() . '/assets/css/home.css', [], false, false);
        //wp_register_style('interno', get_template_directory_uri() . '/assets/css/pagina-interna.css', [], false, false);

        wp_enqueue_style(['owl-carousel-style','owl-theme-style']);
    }
    add_action('wp_enqueue_scripts', 'nature_styles');

    // Funções para Limpar o Header
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0 );
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Habilitar Menus
    add_theme_support('menus');

    //add support to thumbnail post
    add_theme_support( 'post-thumbnails', ['post']);


    //add custom length to excerpt
    function my_excerpt_length($length){
        return 29;
        }
        add_filter('excerpt_length', 'my_excerpt_length');

    // Registrar o Menu
    
    function register_my_menu() {
        register_nav_menus([
            'menu-principal' => __( 'menu principal' ),
            'menu-footer-1' => __('menu footer 1'),
            'menu-footer-2' => __('menu footer 2')
        ]);
    }
    add_action( 'init', 'register_my_menu' );



    //code for count view post
    function wpb_set_post_views($postID) {
        $count_key = 'wpb_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    //To keep the count accurate, lets get rid of prefetching
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    
?>