<?php

if(is_search()){
    $bg_color = get_option('show_color_ads_sidebar_search');
    $img_ads_sidebar = get_option('show_img_ads_sidebar_search');
    $title = get_option('show_title_ads_sidebar_search');
    $color_title = get_option('show_color_title_ads_sidebar_search');
    $txt = get_option('show_text_ads_sidebar_search');
    $color_txt_button = get_option('show_color_txt_cta_ads_sidebar_search');
    $color_button = get_option('show_color_cta_ads_sidebar_search');
    $cta = get_option('show_cta_ads_sidebar_search');
    $link = get_option('show_link_ads_sidebar_search');
}elseif(is_category()){
    $bg_color = get_option('show_color_ads_sidebar_category');
    $img_ads_sidebar = get_option('show_img_ads_sidebar_category');
    $title = get_option('show_title_ads_sidebar_category');
    $color_title = get_option('show_color_title_ads_sidebar_category');
    $txt = get_option('show_text_ads_sidebar_category');
    $color_txt_button = get_option('show_color_txt_cta_ads_sidebar_category');
    $color_button = get_option('show_color_cta_ads_sidebar_category');
    $cta = get_option('show_cta_ads_sidebar_category');
    $link = get_option('show_link_ads_sidebar_category');
}else{
    $bg_color = get_option('show_color_ads_sidebar');
    $img_ads_sidebar = get_option('show_img_ads_sidebar');
    $title = get_option('show_title_ads_sidebar');
    $color_title = get_option('show_color_title_ads_sidebar');
    $txt = get_option('show_text_ads_sidebar');
    $color_txt_button = get_option('show_color_txt_cta_ads_sidebar');
    $color_button = get_option('show_color_cta_ads_sidebar');
    $cta = get_option('show_cta_ads_sidebar');
    $link = get_option('show_link_ads_sidebar');
}

?>

<section id="products">
    <div class="all-suplements" style="background-color: <?= $bg_color; ?>">
        <img style="width: 120px;" src="<?= wp_get_attachment_image_url( $img_ads_sidebar, 'normal' ); ?>">
        <h4 style="color: <?= $color_title; ?> "><?= $title; ?></h4>
        <p><?= $txt; ?></p>
        <button class="btn btn-blue" style="background-color: <?= $color_button; ?>; color: <?= $color_txt_button; ?>"><?= $cta; ?></button>
        <a href="<?= $link; ?>" class="link"></a>
    </div>
</section>
