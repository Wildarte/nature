<section id="categories">
    <h2>Explore por categoria</h2>
    <div class="categories">

    <?php
        if(is_category()) $current_cat = get_the_category(); //pega a categoria da página atual
        $terms = get_terms([
            'taxonomy' => 'category',
            'hide_empty' => false
        ]);
        foreach($terms as $term){ ?>
            <a class='category <?= $current_cat[0]->name == $term->name ? 'active' : '' ?>' href='<?= get_category_link($term->term_id); ?>'><?= $term->name; ?><img src='<?= get_template_directory_uri(); ?>/assets/img/icons/next.svg'></a>       
        <?php }
        
        
    ?>

    </div>
</section>