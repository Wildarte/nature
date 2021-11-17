<section id="categories">
    <h2>Explore por categoria</h2>
    <div class="categories">

    <?php
        $terms = get_terms([
            'taxonomy' => 'category',
            'hide_empty' => false
        ]);
        foreach($terms as $term){
            echo "<a class='category' href='". get_category_link($term->term_id). "'>".$term->name."<img src='".get_template_directory_uri()."/assets/img/icons/next.svg'></a>";        
        }
        
        
    ?>

    </div>
</section>