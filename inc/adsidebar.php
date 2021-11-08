<section id="products">
    <div class="all-suplements">
        <?php $img_ads_sidebar = get_option('show_img_ads_sidebar'); ?>
        <img src="<?= wp_get_attachment_image_url( $img_ads_sidebar, 'normal' ); ?>">
        <h4><?= get_option('show_title_ads_sidebar') ?></h4>
        <p><?= get_option('show_text_ads_sidebar') ?></p>
        <button class="btn btn-blue"><?= get_option('show_cta_ads_sidebar'); ?></button>
        <a href="<?= get_option('show_link_ads_sidebar') ?>" class="link"></a>
    </div>
</section>