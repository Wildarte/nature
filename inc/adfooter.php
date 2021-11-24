<div class="card" style="background-color: <?= get_option('show_color_ads_footer'); ?>;">
    <div class="card-image">
    <?php $img_ads_footer = get_option('show_img_ads_footer'); ?>
        <img src="<?= wp_get_attachment_image_url( $img_ads_footer, 'normal' ); ?>">
    </div>
    <div class="card-text">
        <h4 class="title"><?= get_option('show_title_ads_footer'); ?></h4>
        <p><?= get_option('show_text_ads_footer'); ?></p>
    </div>
    <button class="btn" style="background-color: <?= get_option('show_color_cta_ads_footer'); ?>; color: <?= get_option('show_color_txt_cta_ads_footer'); ?>"><?= get_option('show_cta_ads_footer'); ?></button>
    <a href="<?= get_option('show_link_ads_footer'); ?>" class="link"></a>
</div>