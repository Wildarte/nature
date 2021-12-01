<?php

if(is_search()){
    $bg_color = get_option('show_color_ads_footer_search');
    $img_ads_footer = get_option('show_img_ads_footer_search');
    $title = get_option('show_title_ads_footer_search');
    $color_title = get_option('show_color_title_ads_footer_search');
    $txt = get_option('show_text_ads_footer_search');
    $color_txt_button = get_option('show_color_txt_cta_ads_footer_search');
    $color_button = get_option('show_color_cta_ads_footer_search');
    $cta = get_option('show_cta_ads_footer_search');
    $link = get_option('show_link_ads_footer_search');
}elseif(is_category()){
    $bg_color = get_option('show_color_ads_footer_category');
    $img_ads_footer = get_option('show_img_ads_footer_category');
    $title = get_option('show_title_ads_footer_category');
    $color_title = get_option('show_color_title_ads_footer_category');
    $txt = get_option('show_text_ads_footer_category');
    $color_txt_button = get_option('show_color_txt_cta_ads_footer_category');
    $color_button = get_option('show_color_cta_ads_footer_category');
    $cta = get_option('show_cta_ads_footer_category');
    $link = get_option('show_link_ads_footer_category');
}else{
    $bg_color = get_option('show_color_ads_footer');
    $img_ads_footer = get_option('show_img_ads_footer');
    $title = get_option('show_title_ads_footer');
    $color_title = get_option('show_color_title_ads_footer');
    $txt = get_option('show_text_ads_footer');
    $color_txt_button = get_option('show_color_txt_cta_ads_footer');
    $color_button = get_option('show_color_cta_ads_footer');
    $cta = get_option('show_cta_ads_footer');
    $link = get_option('show_link_ads_footer');
}

?>


<div class="card" style="background-color: <?= $bg_color; ?>;">
    <div class="card-image">
        <img style="width: 42px;" src="<?= wp_get_attachment_image_url( $img_ads_footer, 'normal' ); ?>">
    </div>
    <div class="card-text">
        <h4 class="title" style="color: <?= $color_title; ?>;"><?= $title; ?></h4>
        <p><?= $txt; ?></p>
    </div>
    <button class="btn" style="background-color: <?= $color_button; ?>; color: <?= $color_txt_button; ?>"><?= $cta; ?></button>
    <a href="<?= $link; ?>" class="link"></a>
</div>