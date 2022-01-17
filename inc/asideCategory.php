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
                    $link_icon_arrow = "";
             switch($term->slug):
                case "carta-ao-homem":
                    if($current_cat[0]->name == $term->name){
                        $link_icon = "sexo-masculino-orange.png";
                        $link_icon_arrow = "next-orange.png";
                    }else{
                        $link_icon = "sexo-masculino.png";
                        $link_icon_arrow = "next.svg";
                    }
                break;
                case "saude-natural":
                    if($current_cat[0]->name == $term->name){
                        $link_icon = "folha-delineada-forma-natural-orange.png";
                        $link_icon_arrow = "next-orange.png";
                    }else{
                        $link_icon = "folha-delineada-forma-natural.png";
                        $link_icon_arrow = "next.svg";
                    }
                break;
                case "viva-sem-dores":
                    if($current_cat[0]->name == $term->name){
                        $link_icon = "coluna-orange.png";
                        $link_icon_arrow = "next-orange.png";
                    }else{
                        $link_icon = "coluna.png";
                        $link_icon_arrow = "next.svg";
                    }
                break;
                default:
                    echo "";
            endswitch;
                ?>
            <a class='category <?= $current_cat[0]->name == $term->name ? 'active' : '' ?>' href='<?= get_category_link($term->term_id); ?>'><img class="icon_category" src="<?= get_template_directory_uri() ?>/assets/img/icons/<?= $link_icon; ?>"><span><?= $term->name; ?></span><img class="icon_next" src='<?= get_template_directory_uri(); ?>/assets/img/icons/<?= $link_icon_arrow; ?>'></a>       
        <?php }
     
    ?>

    </div>
</section>