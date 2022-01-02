<section id="categories">
    <h2>Explore por categoria</h2>
    <div class="categories">

    <?php
        if(is_category()) $current_cat = get_the_category(); //pega a categoria da página atual
        $terms = get_terms([
            'taxonomy' => 'category',
            'hide_empty' => false,
            'orderby' => 'term_id'
        ]);
        foreach($terms as $term){ ?>
            <?php $link_icon = "";
             switch($term->slug):
                case "carta-ao-homem":
                    $link_icon = "sexo-masculino.png";
                break;
                case "saude-natural":
                    $link_icon = "folha-delineada-forma-natural.png";
                break;
                case "viva-sem-dores":
                    $link_icon = "coluna.png";
                break;
                default:
                    echo "";
            endswitch;
                ?>
            <a class='category <?= $current_cat[0]->name == $term->name ? 'active' : '' ?>' href='<?= get_category_link($term->term_id); ?>'><img class="icon_category" src="<?= get_template_directory_uri() ?>/assets/img/icons/<?= $link_icon; ?>"><span><?= $term->name; ?></span><img class="icon_next" src='<?= get_template_directory_uri(); ?>/assets/img/icons/next.svg'></a>       
        <?php }
     
    ?>

    </div>
</section>