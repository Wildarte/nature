<?php
    
    //require './../../../../wp-config.php';
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );    

    $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if(isset($form)):
        $add_post = $_POST['post_add']
       ?>
            <div class="add_post">
            Selecione o post a fixar <select class="select-search-input<?= $add_post; ?>" name="show_lista_posts_sidebar[]" id="show_lista_posts_sidebar<?= $add_post; ?>" style="">
            <?php
                $args_post_slide = [
                    'post_type' => 'post',
                    'order' => 'DESC',
                    'posts_per_page' => -1
                ];
                $result_post_slide = new WP_query($args_post_slide);
            if($result_post_slide->have_posts()): while($result_post_slide->have_posts()): $result_post_slide->the_post(); ?>
                <option value="<?= get_the_ID(); ?>" <?= $val_list_post_sidebar == get_the_title() ? "selected" : "" ?>><?= the_title(); ?></option>
            <?php endwhile; endif; wp_reset_query(); wp_reset_postdata(); ?>
        </select>
        </div>
        <script>
            var select<?= $add_post; ?> = new SlimSelect({
                select: '.select-search-input<?= $add_post; ?>'
            });   
        </script>

<?php 


endif; ?>
   
