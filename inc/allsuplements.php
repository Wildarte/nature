
<?php

if(is_search()){
    $html = get_option('show_ads_html_sidebar_search');
}elseif(is_category()){

    $html = get_option('show_ads_html_sidebar_category');
}else{
    $html = get_option('show_ads_html_sidebar_home');
}

?>
<div class="all-suplements">

<?= $html; ?>
<!-- 
    <h4><?= get_option('show_title_ads_sidebar') ?></h4>
    <p><?= get_option('show_text_ads_sidebar') ?></p>
    <button class="btn btn-blue">Saiba mais</button>
    <?php $img_ads_sidebar = get_option('show_img_ads_sidebar'); ?>
    <img src="<?= wp_get_attachment_image_url( $img_ads_sidebar, 'normal' ); ?>">
    <a href="<?= get_option('show_link_ads_sidebar') ?>" class="link"></a>
     -->
</div>